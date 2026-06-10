<?php

namespace App\Http\Controllers\MemberBasic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seminar;

class SeminarController extends Controller
{
    /**
     * Menampilkan daftar seminar yang tersedia untuk peserta.
     * Menggunakan scopeActive yang sudah kita buat di Model.
     */
    public function index()
    {
        // Menggunakan scopeActive agar lebih bersih dan konsisten
        $seminars = Seminar::active()
                            ->orderBy('event_date', 'asc')
                            ->get();

        return view('member_basic.seminars.index', compact('seminars'));
    }

    /**
     * Menampilkan detail seminar tertentu beserta fitur tambahannya.
     */
public function show($slug)
{
    $seminar = Seminar::where('slug', $slug)->active()->firstOrFail();
    $user = auth()->user();

    // Cek apakah user sudah terdaftar
    $isRegistered = $seminar->users()->where('user_id', $user->id)->exists();

    // Cek apakah acara sudah selesai (Selesai = Terbuka untuk Umum)
    // Kita anggap acara selesai jika lewat 24 jam dari event_date
    $isFinished = $seminar->event_date->isPast();

    // Akses Terbuka JIKA: Sudah Daftar ATAU Acara Sudah Selesai
    $hasFullAccess = $isRegistered || $isFinished;

    return view('member_basic.seminars.show', compact('seminar', 'isRegistered', 'isFinished', 'hasFullAccess'));
}

// Logic untuk Pendaftaran (Simpan data pendaftaran)
public function register(Request $request, $id)
{
    $seminar = Seminar::findOrFail($id);

    // Daftarkan user ke seminar (attach)
    $seminar->users()->syncWithoutDetaching([auth()->id()]);

    return back()->with('success', 'Selamat! Anda berhasil terdaftar. Akses fitur seminar kini terbuka.');
}

public function claimAttendance(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $seminar = Seminar::findOrFail($id);
    $user = auth()->user();

    // 1. Simpan Feedback
    SeminarFeedback::create([
        'seminar_id' => $seminar->id,
        'user_id' => $user->id,
        'rating' => $request->rating,
        'message' => $request->message ?? '-',
    ]);

    // 2. Update Status Kehadiran di Tabel Pivot
    $seminar->users()->updateExistingPivot($user->id, [
        'attendance_status' => true,
    ]);

    return back()->with('success', "Berhasil! Kehadiran Anda telah tercatat.");
}

}
