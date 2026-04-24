<?php

namespace App\Http\Controllers\MemberBasic\Bayu\Seminar; // 4/18/2026 Edit Bayu - Mengubah namespace sesuai restrukturisasi folder

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

        return view('member_basic.bayu.seminar.index', compact('seminars')); // 4/18/2026 Edit Bayu - Update path view seminar
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
        return view('member_basic.bayu.seminar.show', compact('seminar', 'isRegistered', 'isFinished', 'hasFullAccess', 'userPivot')); // 4/18/2026 Edit Bayu - Update path view seminar
    }

    // Logic untuk Pendaftaran dengan Kuota & Tipe Pembayaran (Ecosystem Refinement)
    public function register(Request $request, $id)
    {
        // Gunakan lockForUpdate untuk mencegah race condition (berebut kuota di detik yang sama)
        $seminar = Seminar::lockForUpdate()->findOrFail($id);

        if ($seminar->status === 'Closed') {
            return back()->with('error', 'Mohon maaf, sesi pendaftaran seminar ini sudah ditutup.');
        }

        if ($seminar->quota_remaining <= 0) {
            return back()->with('error', 'Mohon maaf, kuota pendaftaran sudah penuh.');
        }

        $paymentStatus = $seminar->seminar_type === 'paid' ? 'pending' : 'paid'; // Default paid if free

        // Daftarkan user ke seminar dengan data ecosystem awal
        $seminar->users()->syncWithoutDetaching([
            auth()->id() => [
                'payment_status' => $paymentStatus,
                'attendance_status' => false,
                'feedback_status' => false,
                'quiz_status' => false,
                'point_earned' => 0
            ]
        ]);

        // Kurangi kuota secara aman
        $seminar->decrement('quota_remaining');
        
        // Auto-close jika kuota abis
        if ($seminar->quota_remaining <= 0) {
            $seminar->update(['status' => 'Full']);
        }

        if ($paymentStatus === 'pending') {
            return back()->with('success', 'Berhasil mendaftar! Segera selesaikan pembayaran untuk mendapatkan akses.');
        }

        return back()->with('success', 'Selamat! Anda berhasil terdaftar. Akses fitur seminar kini terbuka.');
    }

    public function claimPoint(Request $request, $id)
    {
        $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'answers' => 'nullable|array', 
        ]);

        $seminar = Seminar::findOrFail($id);
        $user = auth()->user();
        
        // [KEAMANAN] Cegah user melakukan submit berkali-kali untuk panen XP
        $pivot = $seminar->users()->where('user_id', $user->id)->first();
        if (!$pivot) {
            return back()->with('error', 'Akses ditolak. Anda belum terdaftar di misi ini.');
        }
        if ($pivot->pivot->attendance_status && $pivot->pivot->feedback_status) {
            return back()->with('error', 'Kecurangan terdeteksi! Anda sudah mengklaim aktivitas ini.');
        }

        // Logic Gamifikasi: Poin maksimal 100
        $pointEarned = 100;
        
        // 1. Presensi (Asumsi karena klik fungsi klaim ini, berarti hadir)
        $attendanceStatus = true; 
        // Jika attendance_status false, point -= 30 (tapi di sini kita set true karena user melakukan aksi klaim)
        
        // 2. Feedback Form logic
        $feedbackStatus = $request->filled('rating');
        if (!$feedbackStatus) {
            $pointEarned -= 30; // Penalti tidak isi feedback
        } else {
            SeminarFeedback::create([
                'seminar_id' => $seminar->id,
                'user_id' => $user->id,
                'rating' => $request->rating,
                'message' => $request->message ?? '-',
            ]);
        }

        // 3. Quiz logic
        $quizStatus = $request->filled('answers');
        $quizScore = 0;
        
        if (!$quizStatus) {
            $pointEarned -= 40; // Penalti tidak ikut quiz
        } else {
            $questions = SeminarQuiz::where('seminar_id', $seminar->id)->get();
            foreach ($questions as $q) {
                if (isset($request->answers[$q->id]) && $request->answers[$q->id] == $q->correct_answer) {
                    $quizScore += $q->points;
                }
            }
        }

        // Final sanity check on point_earned (min 0)
        $pointEarned = max(0, $pointEarned);

        // 4. Update data gamifikasi ke Pivot
        $seminar->users()->updateExistingPivot($user->id, [
            'attendance_status' => $attendanceStatus,
            'feedback_status' => $feedbackStatus,
            'quiz_status' => $quizStatus,
            'quiz_score' => $quizScore,
            'point_earned' => $pointEarned,
            'total_points' => $pointEarned, // Simpan total poin
        ]);

        return back()->with('success', "Claim Berhasil! Kamu mendapatkan $pointEarned Poin Gamifikasi.");
    }
}
