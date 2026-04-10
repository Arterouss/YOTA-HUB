<?php

namespace App\Http\Controllers\MemberBasic\Bayu;

// 3/31/2026 Edit Bayu - Controller E-Learning Modul Layer 1 (Single Table Design menggunakan Seminar)
use App\Http\Controllers\Controller;
use App\Models\Seminar;
use Illuminate\Http\Request;

class LearningModuleController extends Controller
{
    /**
     * Halaman Daftar Semua Modul E-Learning
     */
    public function index()
    {
        $user = auth()->user();

        // Ambil semua seminar yang tipenya E-Learning
        $modules = Seminar::active()->where('type', 'E-Learning')->get();

        // Hitung progress (0 atau 100 karena 1 modul = 1 materi terpadu)
        $progressMap = [];
        foreach ($modules as $module) {
            $pivot = $module->users()->where('user_id', $user->id)->first();
            $progressMap[$module->id] = ($pivot && $pivot->pivot->is_attended) ? 100 : 0;
        }

        return view('member_basic.bayu.modules.index', compact('modules', 'progressMap'));
    }

    /**
     * Halaman Detail Modul Terpadu (Video, PDF, Artikel dalam 1 halaman)
     */
    public function show($slug)
    {
        $user = auth()->user();
        $module = Seminar::active()
            ->where('type', 'E-Learning')
            ->where('slug', $slug)
            ->firstOrFail();

        $pivot = $module->users()->where('user_id', $user->id)->first();
        $isDone = ($pivot && $pivot->pivot->is_attended);
        $progress = $isDone ? 100 : 0;

        return view('member_basic.bayu.modules.show', compact('module', 'isDone', 'progress'));
    }

    /**
     * Aksi "Selesai Modul" - Klaim XP (untuk modul grading_type=auto)
     */
    public function markDone(Request $request, $id)
    {
        $user = auth()->user();
        $module = Seminar::findOrFail($id);

        $pivot = $module->users()->where('user_id', $user->id)->first();
        if ($pivot && $pivot->pivot->is_attended) {
            return back()->with('info', 'Anda sudah menyelesaikan modul ini sebelumnya!');
        }

        if (!$pivot) {
            $module->users()->attach($user->id, [
                'is_attended' => true,
                'total_points' => 100,
            ]);
        } else {
            $module->users()->updateExistingPivot($user->id, [
                'is_attended' => true,
                'total_points' => $module->quota ?? 100,
            ]);
        }

        return back()->with('success', "🎉 Keren! Kamu mendapat +{$module->quota} XP Kompetensi karena telah menyelesaikan modul ini!");
    }

    /**
     * 4/5/2026 Edit Bayu - Mahasiswa submit link tugas (grading_type=manual)
     */
    public function submitLink(Request $request, $id)
    {
        $request->validate([
            'submission_link' => 'required|url|max:500',
            'submission_note' => 'nullable|string|max:1000',
        ]);

        $user = auth()->user();
        $module = Seminar::findOrFail($id);

        $pivot = $module->users()->where('user_id', $user->id)->first();

        if (!$pivot) {
            $module->users()->attach($user->id, [
                'submission_link' => $request->submission_link,
                'submission_note' => $request->submission_note,
                'is_attended'     => false,
                'total_points'    => 0,
            ]);
        } else {
            $module->users()->updateExistingPivot($user->id, [
                'submission_link' => $request->submission_link,
                'submission_note' => $request->submission_note,
            ]);
        }

        return back()->with('success', '📎 Tugas berhasil dikumpulkan! Tunggu penilaian dari Admin Program.');
    }
}
