@extends('admin.layouts.app')

@section('title', 'Edit Seminar/Webinar')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.seminars.index') }}" class="text-xs font-bold text-slate-500 dark:text-slate-400 hover:text-lime-600 mb-2 inline-block">← KEMBALI</a>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Edit Seminar: {{ $seminar->title }}</h2>
    </div>

    <form action="{{ route('admin.seminars.update', $seminar->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white dark:bg-slate-900 shadow-sm border border-slate-200 dark:border-slate-800 rounded-2xl p-6 space-y-4">
            <div>
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Judul Acara</label>
                <input type="text" name="title" value="{{ $seminar->title }}" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Deskripsi Lengkap</label>
                <textarea name="description" rows="4" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">{{ $seminar->description }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Pembicara</label>
                    <input type="text" name="speaker" value="{{ $seminar->speaker }}" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tanggal & Waktu</label>
                    <input type="datetime-local" name="event_date" value="{{ \Carbon\Carbon::parse($seminar->event_date)->format('Y-m-d\TH:i') }}" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Lokasi (Alamat / Titik Kumpul)</label>
                    <input type="text" name="location" value="{{ $seminar->location }}" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Link Meeting (Zoom/Gmeet)</label>
                    <input type="url" name="meeting_link" value="{{ $seminar->meeting_link }}" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Format Acara</label>
                    <select name="type" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                        <option value="online" {{ $seminar->type == 'online' ? 'selected' : '' }}>Online (Webinar)</option>
                        <option value="offline" {{ $seminar->type == 'offline' ? 'selected' : '' }}>Offline (Seminar)</option>
                        <option value="hybrid" {{ $seminar->type == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="E-Learning" {{ $seminar->type == 'E-Learning' ? 'selected' : '' }}>E-Learning</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Status Pendaftaran</label>
                    <select name="status" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                        <option value="Open" {{ $seminar->status == 'Open' ? 'selected' : '' }}>Open (Buka)</option>
                        <option value="Full" {{ $seminar->status == 'Full' ? 'selected' : '' }}>Full (Penuh)</option>
                        <option value="Closed" {{ $seminar->status == 'Closed' ? 'selected' : '' }}>Closed (Tutup)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tipe Penilaian (Syarat Sertifikat)</label>
                <select name="grading_type" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                    <option value="auto" {{ $seminar->grading_type == 'auto' ? 'selected' : '' }}>Otomatis (Hanya Kuis & Evaluasi)</option>
                    <option value="manual" {{ $seminar->grading_type == 'manual' ? 'selected' : '' }}>Manual (Wajib Kumpul Link Tugas)</option>
                </select>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Pilih "Manual" jika Anda mewajibkan peserta untuk mengumpulkan file tugas/resume dalam bentuk Google Drive link.</p>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tipe Tiket</label>
                    <select name="seminar_type" required class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                        <option value="free" {{ $seminar->seminar_type == 'free' ? 'selected' : '' }}>Gratis (Free)</option>
                        <option value="paid" {{ $seminar->seminar_type == 'paid' ? 'selected' : '' }}>Berbayar (Paid)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ $seminar->price }}" min="0" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Total Kuota</label>
                    <input type="number" name="quota_total" value="{{ $seminar->quota_total }}" required min="1" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white">
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full px-4 py-3 bg-blue-500 text-white rounded-xl font-bold hover:bg-blue-600 transition-colors">
                    Simpan Perubahan Acara
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
