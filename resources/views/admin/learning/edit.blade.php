@extends('admin.layouts.app')

@section('title', 'Edit Modul E-Learning')

@section('content')
<div class="min-h-screen bg-slate-50 p-8">
    <div class="max-w-3xl mx-auto">

        <a href="{{ route('admin.learning.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 mb-6 hover:text-lime-600 transition group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar Modul
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            <h1 class="text-2xl font-black text-slate-900 mb-6">✏️ Edit Modul: {{ $module->title }}</h1>

            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.learning.update', $module->id) }}" method="POST" class="space-y-6">
                @csrf @method('PUT')

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Judul Modul *</label>
                    <input type="text" name="title" value="{{ old('title', $module->title) }}" required
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-lime-400">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Deskripsi / Isi Materi Teks *</label>
                    <textarea name="description" rows="6" required
                              class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-lime-400">{{ old('description', $module->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Link Video YouTube (Opsional)</label>
                    <input type="url" name="recording_link" value="{{ old('recording_link', $module->recording_link) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-lime-400"
                           placeholder="https://www.youtube.com/watch?v=...">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Link File / PDF (Opsional)</label>
                    <input type="url" name="attachment_link" value="{{ old('attachment_link', $module->attachment_link) }}"
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-lime-400"
                           placeholder="https://drive.google.com/file/...">
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Tipe Penilaian *</label>
                    <select name="grading_type" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-lime-400">
                        <option value="auto" {{ old('grading_type', $module->grading_type) == 'auto' ? 'selected' : '' }}>⚡ Otomatis</option>
                        <option value="manual" {{ old('grading_type', $module->grading_type) == 'manual' ? 'selected' : '' }}>📝 Manual (Submit Tugas)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-lime-600 mb-2">Poin XP yang Didapat Peserta *</label>
                    <input type="number" name="quota" value="{{ old('quota', $module->quota) }}" required min="0"
                           class="w-full px-4 py-3 border border-lime-200 bg-lime-50 rounded-xl text-sm font-bold text-slate-900 focus:outline-none focus:ring-2 focus:ring-lime-500">
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ $module->is_active ? 'checked' : '' }}
                           class="w-5 h-5 rounded accent-lime-500">
                    <label for="is_active" class="text-sm font-bold text-slate-700 cursor-pointer">Modul Aktif (tampil ke peserta)</label>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <button type="submit" class="w-full py-4 bg-slate-900 text-white font-black uppercase tracking-widest rounded-xl hover:bg-lime-500 hover:text-slate-900 transition text-sm">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
