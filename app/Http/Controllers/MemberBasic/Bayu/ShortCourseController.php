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

            CourseEnrollment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'progress_percentage' => 0,
                'status' => 'in_progress'
            ]);

            $course->decrement('quota_remaining');
            if ($course->quota_remaining <= 0) {
                $course->update(['status' => 'full']);
            }

            DB::commit();
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

        return view('member_basic.bayu.shortcourse.learn', compact('course', 'activeModule', 'enrollment', 'progressions'));
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

    public function generateCertificate($course_id)
    {
        $user = Auth::user();
        $enrollment = CourseEnrollment::where('user_id', $user->id)->where('course_id', $course_id)->firstOrFail();

        if ($enrollment->progress_percentage < 100) {
            return back()->with('error', 'Selesaikan seluruh materi untuk mendapatkan sertifikat.');
        }

        // TODO: Impelemntasikan fitur integrasi sistem sertifikat PDF/domPDF disini 
        // Untuk tahap perdana, berikan notifikasi lencana kesuksesan.
        return back()->with('success', 'Sertifikat kelulusan berhasil diproses! [Fitur Download PDF menyusul]');
    }
}
