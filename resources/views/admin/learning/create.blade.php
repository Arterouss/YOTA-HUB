@extends('admin.layouts.app')

@section('title', 'Tambah Modul E-Learning')

@section('content')
<div class="min-h-screen bg-slate-50 p-8">
    <div class="max-w-3xl mx-auto">

        <a href="{{ route('admin.learning.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 mb-6 hover:text-lime-600 transition group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar Modul
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            <h1 class="text-2xl font-black text-slate-900 mb-6">+ Tambah Modul E-Learning Baru</h1>

            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.learning.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Judul Modul *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-lime-400"
                           placeholder="Contoh: Pengantar Inovasi Dasar">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Deskripsi / Isi Materi Teks *</label>
                    <textarea name="description" rows="6" required
                              class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-lime-400"
                              placeholder="Tuliskan konten materi di sini. Mahasiswa akan membaca teks ini di halaman modul.">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Link Video YouTube (Opsional)</label>
                    <input type="url" name="recording_link" value="{{ old('recording_link') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-lime-400"
                           placeholder="https://www.youtube.com/watch?v=...">
                    <p class="text-xs text-slate-400 mt-1">Paste link YouTube. Video akan di-embed langsung di halaman modul.</p>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Link File / PDF (Opsional)</label>
                    <input type="url" name="attachment_link" value="{{ old('attachment_link') }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-lime-400"
                           placeholder="https://drive.google.com/file/...">
                    <p class="text-xs text-slate-400 mt-1">Link Google Drive, PDF, atau file materi yang bisa diunduh mahasiswa.</p>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Tipe Penilaian *</label>
                    <select name="grading_type" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-lime-400">
                        <option value="auto" {{ old('grading_type') == 'auto' ? 'selected' : '' }}>⚡ Otomatis — Mahasiswa langsung klaim selesai sendiri (tanpa submit tugas)</option>
                        <option value="manual" {{ old('grading_type') == 'manual' ? 'selected' : '' }}>📝 Manual — Mahasiswa wajib kumpulkan link tugas, Admin yang memberi nilai</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-lime-600 mb-2">Poin XP yang Didapat Peserta *</label>
                    <input type="number" name="quota" value="{{ old('quota', 100) }}" required min="0"
                           class="w-full px-4 py-3 border border-lime-200 bg-lime-50 rounded-xl text-sm font-bold text-slate-900 focus:outline-none focus:ring-2 focus:ring-lime-500"
                           placeholder="100">
                    <p class="text-xs text-lime-700 mt-1">Jumlah XP yang akan masuk ke profil mahasiswa setelah lulus/selesai membaca ini.</p>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <button type="submit" class="w-full py-4 bg-lime-500 text-slate-900 font-black uppercase tracking-widest rounded-xl hover:bg-lime-400 transition text-sm">
                        ✅ Simpan Modul
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
