@extends('admin.layouts.app')

@section('title', 'Edit Bab Modul')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.learning.modules.index', $course->id) }}" class="p-2 bg-slate-100 rounded-lg hover:bg-slate-200 text-slate-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h2 class="text-2xl font-bold text-slate-800">Edit Bab: {{ $module->title }}</h2>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <form action="{{ route('admin.learning.modules.update', [$course->id, $module->id]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Urutan Bab (Bab Ke-)</label>
                    <input type="number" name="order_index" value="{{ $module->module_order }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Judul Materi Pembahasan</label>
                    <input type="text" name="title" value="{{ $module->module_title }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Link Video YouTube / HLS (Opsional)</label>
                    <input type="url" name="video_url" value="{{ $module->video_url }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Teks Penjelasan Materi Pendukung</label>
                    <textarea name="content" rows="6" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">{{ $module->text_content }}</textarea>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                <button type="submit" class="px-6 py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
