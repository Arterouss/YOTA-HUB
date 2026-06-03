<?php

namespace App\Http\Controllers\MemberBasic\Bayu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShortCourse;
use App\Models\CourseModule;
use App\Models\CourseEnrollment;
use App\Models\ModuleProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShortCourseController extends Controller
{
    public function index()
    {
        $courses = ShortCourse::where('status', 'open')->orderBy('created_at', 'desc')->paginate(10);
        return view('member_basic.bayu.shortcourse.index', compact('courses'));
    }

    public function show($id)
    {
        $course = ShortCourse::with('modules')->findOrFail($id);
        $user = Auth::user();
        
        $enrollment = CourseEnrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        return view('member_basic.bayu.shortcourse.show', compact('course', 'enrollment'));
    }

    public function enroll(Request $request, $id)
    {
        $user = Auth::user();
        
        DB::beginTransaction();
        try {
            $course = ShortCourse::where('id', $id)->lockForUpdate()->firstOrFail();

            if ($course->status !== 'open') {
                return back()->with('error', 'Pendaftaran kursus sudah ditutup.');
            }

            if ($course->quota_remaining <= 0) {
                return back()->with('error', 'Kuota kursus sudah penuh.');
            }

            // Cek jika sudah terdaftar
            $exists = CourseEnrollment::where('user_id', $user->id)->where('course_id', $course->id)->exists();
            if ($exists) {
                return back()->with('info', 'Anda sudah terdaftar di kursus ini.');
            }

            $paymentStatus = ($course->course_type === 'paid' || $course->price > 0) ? 'pending' : 'paid';

            CourseEnrollment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'progress_percentage' => 0,
                'status' => 'in_progress',
                'payment_status' => $paymentStatus
            ]);

            $course->decrement('quota_remaining');
            if ($course->quota_remaining <= 0) {
                $course->update(['status' => 'full']);
            }

            DB::commit();

            if ($paymentStatus === 'pending') {
                return back()->with('success', 'Berhasil mendaftar! Segera selesaikan pembayaran untuk mulai belajar.');
            }

            return redirect()->route('member.shortcourse.learn', $course->id)
                             ->with('success', 'Berhasil mendaftar kursus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem saat mendaftar.');
        }
    }

    public function learn($course_id, $module_id = null)
    {
        $course = ShortCourse::with(['modules' => function($q) {
            $q->orderBy('module_order', 'asc');
        }])->findOrFail($course_id);

        $user = Auth::user();
        $enrollment = CourseEnrollment::where('user_id', $user->id)->where('course_id', $course->id)->firstOrFail();

        if ($enrollment->payment_status === 'pending') {
            return redirect()->route('member.shortcourse.show', $course->slug ?? $course->id)
                             ->with('error', 'Akses ditolak. Pembayaran kursus Anda masih menunggu verifikasi Admin.');
        }

        // Cari modul yang aktif
        if (!$module_id) {
            $activeModule = $course->modules->first();
        } else {
            $activeModule = CourseModule::findOrFail($module_id);
        }

        if (!$activeModule) {
            return back()->with('error', 'Modul tidak ditemukan.');
        }

        // Ambil riwayat progress user untuk course ini
        $progressions = ModuleProgress::where('user_id', $user->id)
            ->whereIn('module_id', $course->modules->pluck('id'))
            ->get()->keyBy('module_id');

        // Ambil data tugas
        $courseTasks = \App\Models\CourseTask::where('course_id', $course->id)->get();
        $taskSubmissions = collect();
        if ($courseTasks->count() > 0) {
            $taskSubmissions = \App\Models\TaskSubmission::where('user_id', $user->id)
                ->whereIn('task_id', $courseTasks->pluck('id'))
                ->get()->keyBy('task_id');
        }

        return view('member_basic.bayu.shortcourse.learn', compact('course', 'activeModule', 'enrollment', 'progressions', 'courseTasks', 'taskSubmissions'));
    }

    public function completeModule(Request $request, $course_id, $module_id)
    {
        $user = Auth::user();
        $course = ShortCourse::with('modules')->findOrFail($course_id);
        
        $enrollment = CourseEnrollment::where('user_id', $user->id)->where('course_id', $course->id)->firstOrFail();

        $progress = ModuleProgress::firstOrCreate(
            ['user_id' => $user->id, 'module_id' => $module_id],
            ['status' => 'not_started']
        );

        if ($progress->status !== 'completed') {
            $progress->update([
                'status' => 'completed',
                'completed_at' => now()
            ]);

            // Hitung ulang persentase
            $totalModules = $course->modules->count();
            $completedModules = ModuleProgress::where('user_id', $user->id)
                ->whereIn('module_id', $course->modules->pluck('id'))
                ->where('status', 'completed')
                ->count();

            $percentage = $totalModules > 0 ? floor(($completedModules / $totalModules) * 100) : 0;
            
            $enrollData = ['progress_percentage' => $percentage];
            if ($percentage >= 100) {
                $enrollData['status'] = 'completed';
            }
            $enrollment->update($enrollData);
        }

        // Redirect ke modul selanjutnya jika ada
        $currentModule = CourseModule::findOrFail($module_id);
        $nextModule = $course->modules->where('module_order', '>', $currentModule->module_order)->first();

        if ($nextModule) {
            return redirect()->route('member.shortcourse.learn', ['course_id' => $course->id, 'module_id' => $nextModule->id])
                             ->with('success', 'Modul selesai! Lanjutkan ke materi berikutnya.');
        }

        return back()->with('success', 'Selamat! Anda telah menyelesaikan seluruh modul kursus ini.');
    }

    public function submitTask(Request $request, $course_id, $task_id)
    {
        $user = Auth::user();
        $task = \App\Models\CourseTask::where('course_id', $course_id)->findOrFail($task_id);
        
        $request->validate([
            'submission_link' => 'required|url'
        ]);

        $submission = \App\Models\TaskSubmission::updateOrCreate(
            ['user_id' => $user->id, 'task_id' => $task->id],
            [
                'submission_link' => $request->submission_link,
                'status' => 'submitted'
            ]
        );

        return back()->with('success', 'Tugas berhasil dikumpulkan! Menunggu penilaian admin.');
    }

    public function generateCertificate($course_id)
    {
        $user = Auth::user();
        $enrollment = CourseEnrollment::where('user_id', $user->id)->where('course_id', $course_id)->firstOrFail();

        if ($enrollment->progress_percentage < 100) {
            return back()->with('error', 'Selesaikan seluruh materi untuk mendapatkan sertifikat.');
        }

        // Cek jika ada tugas, pastikan semua tugas sudah di-submit dan disetujui
        $courseTasks = \App\Models\CourseTask::where('course_id', $course_id)->get();
        if ($courseTasks->count() > 0) {
            $approvedTasksCount = \App\Models\TaskSubmission::where('user_id', $user->id)
                ->whereIn('task_id', $courseTasks->pluck('id'))
                ->where('status', 'approved')
                ->count();
            
            if ($approvedTasksCount < $courseTasks->count()) {
                return back()->with('error', 'Semua tugas wajib dikumpulkan dan harus menunggu dinilai (Approved) oleh Admin terlebih dahulu.');
            }
        }

        $module = \App\Models\ShortCourse::findOrFail($course_id);
        $record = $enrollment;
        $code = 'SC-' . strtoupper(substr(md5($record->id), 0, 8));

        return view('certificate.course_template', compact('record', 'user', 'module', 'code'));
    }
}
