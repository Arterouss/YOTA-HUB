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

public function claimPoint(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'answers' => 'required|array', // Jawaban dari form kuis
    ]);

    $seminar = Seminar::findOrFail($id);
    $user = auth()->user();
    $totalQuizPoints = 0;

    // 1. Simpan Feedback
    SeminarFeedback::create([
        'seminar_id' => $seminar->id,
        'user_id' => $user->id,
        'rating' => $request->rating,
        'message' => $request->message ?? '-',
    ]);

    // 2. Cek Jawaban Kuis & Hitung Skor
    $questions = SeminarQuiz::where('seminar_id', $seminar->id)->get();
    foreach ($questions as $q) {
        if (isset($request->answers[$q->id]) && $request->answers[$q->id] == $q->correct_answer) {
            $totalQuizPoints += $q->points;
        }
    }

    // 3. Update Poin di Tabel Pivot (Presensi Berhasil)
    // Bonus 20 poin cuma buat yang ngisi feedback (insentif)
    $finalPoints = $totalQuizPoints + 20;

    $seminar->users()->updateExistingPivot($user->id, [
        'attendance_status' => true,
        'quiz_score' => $totalQuizPoints,
        'total_points' => $finalPoints,
    ]);

    return back()->with('success', "Misi Selesai! Kamu dapat $finalPoints Poin Kompetensi.");
}

}
