@extends('admin.layouts.app')

@section('title', 'Tambah Kursus Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.learning.index') }}" class="p-2 bg-slate-100 dark:bg-slate-800 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Tambah E-Learning</h2>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 p-8">
        <form action="{{ route('admin.learning.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Judul Kursus</label>
                    <input type="text" name="title" required class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-slate-900 dark:text-white focus:outline-none focus:border-lime-500 focus:ring-1 focus:ring-lime-500" placeholder="Cth: Dasar Pemrograman Web">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Penyelenggara</label>
                    <input type="text" name="organizer" required class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-slate-900 dark:text-white" placeholder="Cth: YOTA Hub Mentor">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Tipe Kursus</label>
                    <select name="course_type" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-slate-900 dark:text-white">
                        <option value="free">Gratis (Free)</option>
                        <option value="paid">Berbayar (Paid)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="0" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-slate-900 dark:text-white">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Total Kuota Peserta</label>
                    <input type="number" name="quota_total" required class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-slate-900 dark:text-white" placeholder="Cth: 100">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Status Pembukaan</label>
                    <select name="status" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-slate-900 dark:text-white">
                        <option value="open">Buka (Open)</option>
                        <option value="full">Penuh (Full)</option>
                        <option value="closed">Tutup (Closed)</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Tipe Penilaian (Syarat Lulus)</label>
                    <select name="grading_type" required class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-slate-900 dark:text-white">
                        <option value="auto">Otomatis (Selesai nonton semua bab)</option>
                        <option value="manual">Manual (Wajib mengumpulkan tugas akhir)</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Deskripsi Kursus</label>
                    <textarea name="description" rows="5" required class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-slate-900 dark:text-white" placeholder="Jelaskan secara rinci tentang materi yang dipelajari..."></textarea>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-3">
                <button type="submit" class="px-6 py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition">
                    Simpan Kursus Baru
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
