<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/terms', [App\Http\Controllers\PageController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [App\Http\Controllers\PageController::class, 'privacy'])->name('privacy');
use App\Http\Controllers\Auth\SocialiteController;

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\PublicationController;

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Utama (Layer 1 - Basic/Verified)
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Workspace Super Admin (manage users)
    Route::middleware(['role:super_admin'])->prefix('admin/master')->group(function () {
        Route::get('/', [SuperAdminController::class, 'index'])->name('admin.super.index');
    });

    // Workspace Admin Program (manage programs)
    Route::middleware(['permission:manage programs'])->prefix('admin/programs')->group(function () {
        Route::get('/', [ProgramController::class, 'index'])->name('admin.programs.index');
    });

    // Workspace Admin Publikasi (publish articles)
    Route::middleware(['permission:publish articles'])->prefix('admin/publications')->group(function () {
        Route::get('/', [PublicationController::class, 'index'])->name('admin.publications.index');
    });
});






///member basic
// [2026-03-12] - Dikerjakan oleh Bayu
// Mengubah namespace dan lokasi controller seminar ke fitur Bayu (Refactoring Folder)
use App\Http\Controllers\MemberBasic\Bayu\Seminar\SeminarController;
// Menambahkan fitur Module Bayu sesuai penugasan
use App\Http\Controllers\MemberBasic\Bayu\BayuModuleController;

Route::middleware(['auth', 'verified'])->group(function () {

    // [2026-03-12] - Bayu
    // Group khusus fitur Layer 1 (Member Basic) -> Learning Center
    // Membungkus logic halaman Seminar dan Modul Bayu
    Route::prefix('learning')->group(function () {
        // --- FITUR SEMINAR --- 
        // Fungsi: Menampilkan daftar seminar dan detail halaman seminar
        Route::get('/seminars', [SeminarController::class, 'index'])->name('member.seminars.index');
        Route::get('/seminars/{slug}', [SeminarController::class, 'show'])->name('member.seminars.show');

        // Route Baru untuk Register
        Route::post('/seminars/{id}/register', [SeminarController::class, 'register'])->name('member.seminars.register');
        Route::post('/seminars/{id}/claim', [SeminarController::class, 'claimPoint'])->name('member.seminars.claim');

        // --- FITUR MODULE BAYU ---
        // Fungsi: Menampilkan open module tugas fitur baru dari Bayu
        Route::get('/bayu-module', [BayuModuleController::class, 'index'])->name('member.bayu.index');

        // 3/31/2026 Edit Bayu - Route baru: Fitur E-Learning Modul Layer 1
        Route::get('/modules', [\App\Http\Controllers\MemberBasic\Bayu\LearningModuleController::class, 'index'])->name('member.modules.index');
        Route::get('/modules/{slug}', [\App\Http\Controllers\MemberBasic\Bayu\LearningModuleController::class, 'show'])->name('member.modules.show');
        Route::post('/modules/{id}/done', [\App\Http\Controllers\MemberBasic\Bayu\LearningModuleController::class, 'markDone'])->name('member.modules.markDone');

        // 4/5/2026 Edit Bayu - Route Pengumpulan Tugas (Submit Link)
        Route::post('/modules/{id}/submit', [\App\Http\Controllers\MemberBasic\Bayu\LearningModuleController::class, 'submitLink'])->name('member.modules.submit');

        // 4/5/2026 Edit Bayu - Route Download Piagam (untuk mahasiswa)
        Route::get('/certificate/{code}/download', [\App\Http\Controllers\CertificateVerifyController::class, 'download'])->name('member.certificate.download');
    });

    // 4/5/2026 Edit Bayu - Admin Learning: Kelola Modul E-Learning
    Route::middleware(['role:super_admin|admin_layer1'])->prefix('admin/learning')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\LearningAdminController::class, 'index'])->name('admin.learning.index');
        Route::get('/create', [\App\Http\Controllers\Admin\LearningAdminController::class, 'create'])->name('admin.learning.create');
        Route::post('/', [\App\Http\Controllers\Admin\LearningAdminController::class, 'store'])->name('admin.learning.store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Admin\LearningAdminController::class, 'edit'])->name('admin.learning.edit');
        Route::put('/{id}', [\App\Http\Controllers\Admin\LearningAdminController::class, 'update'])->name('admin.learning.update');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\LearningAdminController::class, 'destroy'])->name('admin.learning.destroy');
    });

    // 4/5/2026 Edit Bayu - Admin Program: Publish Nilai & Piagam
    Route::middleware(['role:super_admin|admin_layer1'])->prefix('admin/certificates')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\CertificateAdminController::class, 'index'])->name('admin.certificates.index');
        Route::get('/{id}', [\App\Http\Controllers\Admin\CertificateAdminController::class, 'show'])->name('admin.certificates.show');
        Route::post('/{moduleId}/publish/{userId}', [\App\Http\Controllers\Admin\CertificateAdminController::class, 'publishCertificate'])->name('admin.certificates.publish');
    });
});

// 4/5/2026 Edit Bayu - Route Publik: Verifikasi QR Code (tanpa login)
Route::get('/verify/{code}', [\App\Http\Controllers\CertificateVerifyController::class, 'verify'])->name('certificate.verify');

require __DIR__.'/auth.php';
