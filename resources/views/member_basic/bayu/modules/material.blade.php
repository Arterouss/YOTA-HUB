@extends('member_basic.layouts.app')

@section('title', $material->title)

@section('content')
{{-- 3/31/2026 Edit Bayu - Halaman player/reader konten materi individual --}}
<div class="max-w-5xl mx-auto pb-20">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs text-slate-400 font-bold mb-8">
        <a href="{{ route('member.modules.index') }}" class="hover:text-lime-600 transition">Modul</a>
        <span>›</span>
        <a href="{{ route('member.modules.show', $material->module->slug) }}" class="hover:text-lime-600 transition">{{ $material->module->title }}</a>
        <span>›</span>
        <span class="text-slate-600">{{ $material->title }}</span>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="mb-6 flex items-center gap-3 p-4 bg-lime-50 border border-lime-200 rounded-2xl text-lime-800">
        <span class="text-xl">🎉</span>
        <p class="font-bold text-sm">{{ session('success') }}</p>
    </div>
    @endif
    @if(session('info'))
    <div class="mb-6 flex items-center gap-3 p-4 bg-blue-50 border border-blue-200 rounded-2xl text-blue-800">
        <span class="text-xl">ℹ️</span>
        <p class="font-bold text-sm">{{ session('info') }}</p>
    </div>
    @endif

    {{-- Header Materi --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
        <div class="flex items-center gap-3 mb-4">
            <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-slate-100 text-slate-600">
                {{ $material->type === 'video' ? '🎬 Video' : ($material->type === 'pdf' ? '📄 PDF' : '📝 Artikel') }}
            </span>
            @if($material->duration_minutes)
            <span class="text-xs text-slate-400">⏱ {{ $material->duration_minutes }} menit</span>
            @endif
            <span class="ml-auto text-xs font-black text-lime-600">+{{ $material->xp_reward }} XP</span>
        </div>
        <h1 class="text-2xl font-bold text-slate-900">{{ $material->title }}</h1>
    </div>

    {{-- Konten Utama: Video / Artikel / PDF --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
        @if($material->type === 'video' && $material->content_url)
            <div class="aspect-video w-full rounded-xl overflow-hidden bg-slate-900 mb-4">
                @php
                    // Konversi link YouTube biasa ke embed URL
                    $videoUrl = $material->content_url;
                    if (str_contains($videoUrl, 'youtube.com/watch?v=')) {
                        $videoId = explode('v=', $videoUrl)[1];
                        $videoId = explode('&', $videoId)[0];
                        $videoUrl = "https://www.youtube.com/embed/$videoId";
                    } elseif (str_contains($videoUrl, 'youtu.be/')) {
                        $videoId = explode('youtu.be/', $videoUrl)[1];
                        $videoId = explode('?', $videoId)[0];
                        $videoUrl = "https://www.youtube.com/embed/$videoId";
                    }
                @endphp
                <iframe src="{{ $videoUrl }}" class="w-full h-full" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>

        @elseif($material->type === 'pdf' && $material->content_url)
            <div class="aspect-video w-full rounded-xl overflow-hidden bg-slate-100 mb-4">
                <iframe src="{{ $material->content_url }}" class="w-full h-full" frameborder="0"></iframe>
            </div>

        @elseif($material->type === 'article' && $material->content_body)
            <div class="prose prose-slate max-w-none">
                {!! nl2br(e($material->content_body)) !!}
            </div>
        @else
            <div class="text-center py-12 text-slate-400">
                <p class="text-4xl mb-3">📭</p>
                <p class="font-bold">Konten belum tersedia.</p>
            </div>
        @endif
    </div>

    {{-- Tombol Aksi: Tandai Selesai --}}
    <div class="flex flex-col sm:flex-row gap-4 items-center">
        <a href="{{ route('member.modules.show', $material->module->slug) }}"
           class="px-6 py-3 border-2 border-slate-200 text-slate-600 text-xs font-bold uppercase rounded-xl hover:border-slate-400 transition">
            ← Kembali ke Daftar Materi
        </a>

        @if($isDone)
            <span class="flex-1 text-center px-6 py-4 bg-lime-100 text-lime-700 font-black uppercase rounded-2xl tracking-widest text-xs cursor-default">
                ✅ Materi Ini Sudah Selesai
            </span>
        @else
            <form action="{{ route('member.modules.done', $material->id) }}" method="POST" class="flex-1">
                @csrf
                <button type="submit" class="w-full px-6 py-4 bg-lime-400 text-slate-900 text-xs font-black uppercase rounded-2xl tracking-widest hover:bg-lime-500 active:scale-95 transition-all shadow-lg shadow-lime-400/30">
                    ✓ Tandai Selesai & Klaim +{{ $material->xp_reward }} XP
                </button>
            </form>
        @endif
    </div>

    {{-- Navigasi Materi Sebelum / Sesudah --}}
    @if($prevMaterial || $nextMaterial)
    <div class="mt-10 border-t border-slate-100 pt-8 grid grid-cols-2 gap-4">
        @if($prevMaterial)
        <a href="{{ route('member.modules.material', $prevMaterial->id) }}"
           class="p-4 rounded-xl border border-slate-100 hover:border-lime-300 hover:bg-lime-50 transition group">
            <p class="text-[10px] font-black uppercase text-slate-400 group-hover:text-lime-600 mb-1">← Sebelumnya</p>
            <p class="text-sm font-bold text-slate-700 line-clamp-2">{{ $prevMaterial->title }}</p>
        </a>
        @else <div></div> @endif

        @if($nextMaterial)
        <a href="{{ route('member.modules.material', $nextMaterial->id) }}"
           class="p-4 rounded-xl border border-slate-100 hover:border-lime-300 hover:bg-lime-50 transition group text-right">
            <p class="text-[10px] font-black uppercase text-slate-400 group-hover:text-lime-600 mb-1">Selanjutnya →</p>
            <p class="text-sm font-bold text-slate-700 line-clamp-2">{{ $nextMaterial->title }}</p>
        </a>
        @endif
    </div>
    @endif

</div>
@endsection
