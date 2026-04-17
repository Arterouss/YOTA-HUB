@extends('admin.layouts.app')

@section('title', 'Tulis Artikel Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.knowledge.index') }}" class="p-2 bg-slate-100 rounded-lg hover:bg-slate-200 text-slate-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="text-2xl font-bold text-slate-800">Tulis Artikel Baru</h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <form action="{{ route('admin.knowledge.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Judul Artikel</label>
                    <input type="text" name="title" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:outline-none focus:border-lime-500 focus:ring-1 focus:ring-lime-500" placeholder="Ketik judul memikat di sini...">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Kategori</label>
                    <select name="category_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Estimasi Waktu Baca (Menit)</label>
                    <input type="number" name="reading_time" value="3" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3" min="1">
                    <span class="text-[10px] text-slate-400 mt-1 block">Ini akan menentukan delay tombol "Klaim Poin" di sisi pembaca.</span>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Link Cover Image (Opsional)</label>
                    <input type="url" name="featured_image" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3" placeholder="https://unsplash.com/photos/...">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Ringkasan (Summary Singkat)</label>
                    <textarea name="summary" rows="3" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3" placeholder="Ringkasan 2 kalimat tentang artikel ini yang akan tampil di halaman depan..."></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Isi Konten Artikel</label>
                    <textarea name="content" rows="15" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 font-mono text-sm leading-relaxed" placeholder="Gunakan sintaks HTML standar untuk formatting paragraf <p>, <strong>, <ul> dll..."></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Status Publikasi</label>
                    <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
                        <option value="draft">Simpan ke Draft (Belum Publikasi)</option>
                        <option value="published">Langsung Publish Sekarang</option>
                    </select>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <button type="submit" class="px-6 py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition">
                    Simpan Artikel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
