@extends('admin.layouts.app')

@section('title', 'Tambah Seminar/Webinar Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.seminars.index') }}" class="text-xs font-bold text-slate-500 dark:text-slate-400 hover:text-lime-600 mb-2 inline-block">← KEMBALI</a>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Tambah Seminar / Webinar</h2>
    </div>

    <form action="{{ route('admin.seminars.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="bg-white dark:bg-slate-900 shadow-sm border border-slate-200 dark:border-slate-800 rounded-2xl p-6 space-y-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Judul Acara</label>
                <input type="text" name="title" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Deskripsi Lengkap</label>
                <textarea name="description" rows="4" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Pembicara</label>
                    <input type="text" name="speaker" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tanggal & Waktu</label>
                    <input type="datetime-local" name="event_date" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Lokasi (Alamat / Titik Kumpul)</label>
                    <input type="text" name="location" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Link Meeting (Zoom/Gmeet)</label>
                    <input type="url" name="meeting_link" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Format Acara</label>
                    <select name="type" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                        <option value="online">Online (Webinar)</option>
                        <option value="offline">Offline (Seminar)</option>
                        <option value="hybrid">Hybrid</option>
                        <option value="E-Learning">E-Learning</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Status Pendaftaran</label>
                    <select name="status" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                        <option value="Open">Open (Buka)</option>
                        <option value="Full">Full (Penuh)</option>
                        <option value="Closed">Closed (Tutup)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tipe Penilaian (Syarat Sertifikat)</label>
                <select name="grading_type" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                    <option value="auto">Otomatis (Hanya Kuis & Evaluasi)</option>
                    <option value="manual">Manual (Wajib Kumpul Link Tugas)</option>
                </select>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Pilih "Manual" jika Anda mewajibkan peserta untuk mengumpulkan file tugas/resume dalam bentuk Google Drive link.</p>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tipe Tiket</label>
                    <select name="seminar_type" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                        <option value="free">Gratis (Free)</option>
                        <option value="paid">Berbayar (Paid)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="0" min="0" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Total Kuota</label>
                    <input type="number" name="quota_total" required min="1" value="100" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full px-4 py-3 bg-lime-400 text-slate-900 dark:text-white rounded-xl font-bold hover:bg-lime-500 transition-colors">
                    Simpan & Publikasikan Acara
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
