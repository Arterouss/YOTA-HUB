<?php

namespace App\Http\Controllers\Admin;

// 4/5/2026 Edit Bayu - Controller untuk Admin Program: nilai & publish piagam
use App\Http\Controllers\Controller;
use App\Models\Seminar;
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
        $modules = Seminar::where('type', 'E-Learning')
            ->with(['users' => function ($q) {
                $q->wherePivot('is_attended', false)
                  ->orWherePivot('certificate_code', null);
            }])
            ->get();

        return view('admin.certificates.index', compact('modules'));
    }

    /**
     * Tampilan detail: daftar mahasiswa per modul
     */
    public function show($id)
    {
        $module = Seminar::where('type', 'E-Learning')->findOrFail($id);
        $students = $module->users()->withPivot('submission_link', 'submission_note', 'quiz_score', 'is_attended', 'certificate_code', 'certificate_issued_at')->get();

        return view('admin.certificates.show', compact('module', 'students'));
    }

    /**
     * Publish nilai + generate certificate (klik "Publish Result")
     */
    public function publishCertificate(Request $request, $moduleId, $userId)
    {
        $request->validate(['grade' => 'required|integer|min:0|max:100']);

        $module = Seminar::findOrFail($moduleId);
        $user = User::findOrFail($userId);

        $pivot = $module->users()->where('user_id', $userId)->first();

        // Generate kode unik untuk QR Code
        $certCode = strtoupper(Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4));

        if (!$pivot) {
            $module->users()->attach($userId, [
                'is_attended'           => true,
                'quiz_score'            => $request->grade,
                'total_points'          => $request->grade,
                'certificate_code'      => $certCode,
                'certificate_issued_at' => now(),
            ]);
        } else {
            $module->users()->updateExistingPivot($userId, [
                'is_attended'           => true,
                'quiz_score'            => $request->grade,
                'total_points'          => $request->grade,
                'certificate_code'      => $certCode,
                'certificate_issued_at' => now(),
            ]);
        }

        return back()->with('success', "✅ Nilai {$request->grade} berhasil dipublish & piagam untuk {$user->name} sudah diterbitkan!");
    }
}
