<?php

namespace App\Http\Controllers;

// 4/5/2026 Edit Bayu - Controller untuk halaman publik verifikasi QR piagam
use App\Models\Seminar;
use Illuminate\Http\Request;

class CertificateVerifyController extends Controller
{
    /**
     * Halaman publik verifikasi QR Code piagam (bisa diakses tanpa login)
     */
    public function verify($code)
    {
        // Cari di semua pivot seminar_user berdasarkan certificate_code
        $record = null;
        $user = null;
        $module = null;

        $seminars = Seminar::where('type', 'E-Learning')->with('users')->get();

        foreach ($seminars as $seminar) {
            foreach ($seminar->users as $u) {
                if ($u->pivot->certificate_code === $code) {
                    $record = $u->pivot;
                    $user   = $u;
                    $module = $seminar;
                    break 2;
                }
            }
        }

        return view('verify.certificate', compact('record', 'user', 'module', 'code'));
    }

    /**
     * Download piagam dalam bentuk print-friendly page (PDF via browser print)
     */
    public function download($code)
    {
        $record = null;
        $user = null;
        $module = null;

        $seminars = Seminar::where('type', 'E-Learning')->with('users')->get();

        foreach ($seminars as $seminar) {
            foreach ($seminar->users as $u) {
                if ($u->pivot->certificate_code === $code) {
                    $record = $u->pivot;
                    $user   = $u;
                    $module = $seminar;
                    break 2;
                }
            }
        }

        if (!$record) {
            abort(404, 'Piagam tidak ditemukan.');
        }

        return view('certificate.template', compact('record', 'user', 'module', 'code'));
    }
}
