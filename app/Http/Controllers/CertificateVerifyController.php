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
        $record = null;
        $user = null;
        $module = null;

        if (str_starts_with($code, 'SC-')) {
            // E-Learning / Short Course Certificate
            $enrollment = \App\Models\CourseEnrollment::with(['user', 'course'])->get()->first(function ($e) use ($code) {
                return 'SC-' . strtoupper(substr(md5($e->id), 0, 8)) === $code;
            });

            if ($enrollment) {
                $record = $enrollment;
                $user = $enrollment->user;
                $module = $enrollment->course; // In view it expects 'module'
                
                // Add a dummy pivot property so the view doesn't break if it expects $record->certificate_issued_at
                $record->certificate_issued_at = $record->updated_at;
            }
        } else {
            // Seminar Certificate
            $seminars = Seminar::with('users')->get();
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

        if (str_starts_with($code, 'SC-')) {
            // E-Learning / Short Course Certificate
            $enrollment = \App\Models\CourseEnrollment::with(['user', 'course'])->get()->first(function ($e) use ($code) {
                return 'SC-' . strtoupper(substr(md5($e->id), 0, 8)) === $code;
            });

            if ($enrollment) {
                $record = $enrollment;
                $user = $enrollment->user;
                $module = $enrollment->course;
                $record->certificate_issued_at = $record->updated_at;
                return view('certificate.course_template', compact('record', 'user', 'module', 'code'));
            }
        } else {
            // Seminar Certificate
            $seminars = Seminar::with('users')->get();

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
        }

        if (!$record) {
            abort(404, 'Piagam tidak ditemukan.');
        }

        return view('certificate.template', compact('record', 'user', 'module', 'code'));
    }
}
