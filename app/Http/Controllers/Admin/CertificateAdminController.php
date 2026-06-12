<?php

namespace App\Http\Controllers\Admin;

// 4/5/2026 Edit Bayu - Controller untuk Admin Program: nilai & publish piagam
use App\Http\Controllers\Controller;
use App\Models\Seminar;
use App\Models\ShortCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificateAdminController extends Controller
{
    /**
     * Tampilkan semua modul E-Learning beserta mahasiswa yang perlu dinilai
     */
    public function index()
    {
        $modules = Seminar::with(['users' => function ($q) {
                $q->wherePivot('attendance_status', false)
                  ->orWherePivot('certificate_code', null);
            }])
            ->get();

        $courses = ShortCourse::all();

        return view('admin.certificates.index', compact('modules', 'courses'));
    }

    /**
     * Tampilan detail: daftar mahasiswa per modul
     */
    public function show($id)
    {
        $module = Seminar::findOrFail($id);
        $students = $module->users()->withPivot('submission_link', 'submission_note', 'attendance_status', 'certificate_code', 'certificate_issued_at')->get();

        return view('admin.certificates.show', compact('module', 'students'));
    }

    /**
     * Publish nilai + generate certificate (klik "Publish Result")
     */
    public function publishCertificate(Request $request, $moduleId, $userId)
    {
        $module = Seminar::findOrFail($moduleId);
        $user = User::findOrFail($userId);

        $pivot = $module->users()->where('user_id', $userId)->first();

        // Generate kode unik untuk QR Code
        $certCode = strtoupper(Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4));

        if (!$pivot) {
            $module->users()->attach($userId, [
                'attendance_status'           => true,
                'certificate_code'      => $certCode,
                'certificate_issued_at' => now(),
            ]);
        } else {
            $module->users()->updateExistingPivot($userId, [
                'attendance_status'           => true,
                'certificate_code'      => $certCode,
                'certificate_issued_at' => now(),
            ]);
        }

        return back()->with('success', "✅ Verifikasi berhasil! Piagam untuk {$user->name} sudah diterbitkan!");
    }

    /**
     * Tampilan detail: daftar peserta E-Learning (Short Course)
     */
    public function showCourse($id)
    {
        $course = ShortCourse::findOrFail($id);
        $enrollments = \App\Models\CourseEnrollment::with('user')->where('course_id', $id)->get();
        
        $courseTask = \App\Models\CourseTask::where('course_id', $id)->first();
        $taskSubmissions = collect();
        if ($courseTask) {
            $taskSubmissions = \App\Models\TaskSubmission::where('task_id', $courseTask->id)
                ->get()
                ->keyBy('user_id');
        }

        return view('admin.certificates.show_course', compact('course', 'enrollments', 'courseTask', 'taskSubmissions'));
    }

    /**
     * Approve Tugas E-Learning
     */
    public function approveTask($course_id, $user_id)
    {
        $courseTask = \App\Models\CourseTask::where('course_id', $course_id)->firstOrFail();
        $submission = \App\Models\TaskSubmission::where('task_id', $courseTask->id)
                                                ->where('user_id', $user_id)
                                                ->firstOrFail();
        
        $submission->update(['status' => 'approved']);

        // Set status enrollment menjadi completed agar mereka bisa mengunduh piagam
        $enrollment = \App\Models\CourseEnrollment::where('course_id', $course_id)
                                                  ->where('user_id', $user_id)
                                                  ->firstOrFail();
        
        $enrollment->update(['status' => 'completed']);

        return back()->with('success', 'Tugas akhir berhasil disetujui (Approved). User sekarang bisa mengklaim piagam!');
    }
}
