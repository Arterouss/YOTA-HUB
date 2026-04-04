<?php

namespace App\Http\Controllers\MemberBasic\Bayu\Seminar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seminar;
use App\Models\SeminarFeedback;
use App\Models\SeminarQuiz;

class SeminarController extends Controller
{
    /**
     * Menampilkan daftar seminar yang tersedia untuk peserta.
     * Menggunakan scopeActive yang sudah kita buat di Model.
     */
    public function index()
    {
        // 3/31/2026 Edit Bayu - Mengubah ->get() menjadi ->paginate(10) untuk menghindari loading lama jika seminar berjumlah ratusan
        $seminars = Seminar::active()
            ->orderBy('event_date', 'asc')
            ->paginate(10);

        return view('member_basic.bayu.seminar.index', compact('seminars'));
    }

    /**
     * Menampilkan detail seminar tertentu beserta fitur tambahannya.
     */
    public function show($slug)
    {
        $seminar = Seminar::where('slug', $slug)->active()->firstOrFail();
        $user = auth()->user();

        // 3/31/2026 Edit Bayu - Membaca data pivot (status daftar/nilai) dalam satu variabel agar hemat query daripada mengeksekusinya berulang-ulang
        $userPivot = $seminar->users()->where('user_id', $user->id)->first();
        $isRegistered = $userPivot !== null;
        $isFinished = $seminar->event_date->isPast();
        $hasFullAccess = $isRegistered || $isFinished;

        // Bawa data userPivot agar view tidak usah menebak-nebak query lagi (hemat load)
        return view('member_basic.bayu.seminar.show', compact('seminar', 'isRegistered', 'isFinished', 'hasFullAccess', 'userPivot'));
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
        
        // 3/31/2026 Edit Bayu - [KEAMANAN] Cegah user melakukan submit berkali-kali untuk panen XP
        $pivot = $seminar->users()->where('user_id', $user->id)->first();
        if (!$pivot) {
            return back()->with('error', 'Akses ditolak. Anda belum terdaftar di misi ini.');
        }
        if ($pivot->pivot->is_attended) {
            return back()->with('error', 'Kecurangan terdeteksi! Anda sudah mengklaim poin untuk misi ini.');
        }

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
            'is_attended' => true,
            'quiz_score' => $totalQuizPoints,
            'total_points' => $finalPoints,
        ]);

        return back()->with('success', "Misi Selesai! Kamu dapat $finalPoints Poin Kompetensi.");
    }
}
