@extends('member_basic.layouts.app')

@section('title', 'Knowledge Hub - Layer 1')
@section('page_header', 'Knowledge Layer: E-Library & Artikel')

@section('content')
<div class="flex flex-col md:flex-row justify-between md:items-end mb-8 gap-4">
    <div>
        <h3 class="text-xl font-bold text-gray-800">Perpustakaan Pengetahuan</h3>
        <p class="text-gray-600">Jelajahi dan baca artikel komunitas, diskusikan, serta dapatkan poin literasi.</p>
    </div>
    
    <form action="{{ route('member.knowledge.index') }}" method="GET" class="w-full md:w-auto relative">
        <input type="text" name="search" placeholder="Cari artikel..." class="w-full bg-white border border-gray-200 rounded-full px-5 py-2 text-sm text-gray-700 outline-none focus:border-blue-500" value="{{ request('search') }}">
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($articles as $article)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col">
        <div class="relative">
            @if($article->featured_image)
                 <img src="{{ asset($article->featured_image) }}" class="h-48 w-full object-cover">
            @else
                 <div class="h-48 w-full bg-gray-100 flex items-center justify-center text-gray-400 font-bold uppercase">
                     {{ $article->category ? $article->category->category_name : 'Artikel' }}
                 </div>
            @endif
            
            @if($article->category)
            <div class="absolute top-4 left-4">
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-slate-800 text-white shadow-sm">
                    {{ $article->category->category_name }}
                </span>
            </div>
            @endif
        </div>

        <div class="p-6 flex flex-col flex-1">
            <div class="flex items-center text-xs text-gray-500 mb-2 gap-3">
                <span>⏱️ {{ $article->reading_time }} Menit Baca</span>
                <span>👁️ {{ $article->view_count }} Views</span>
            </div>

            <h4 class="font-bold text-lg text-gray-900 leading-tight mb-2">{{ $article->title }}</h4>
            <p class="text-sm text-gray-500 line-clamp-3 mb-6 flex-1">{{ $article->summary ?? Str::limit(strip_tags($article->content), 120) }}</p>

            <a href="{{ route('member.knowledge.show', $article->slug) }}" class="inline-flex items-center justify-center w-full px-4 py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition">
                Mulai Membaca
            </a>
        </div>
    </div>
    @empty
    <div class="col-span-full bg-gray-50 p-12 text-center rounded-2xl border-2 border-dashed border-gray-200">
        <p class="text-gray-500">Belum ada artikel yang dipublikasikan saat ini.</p>
    </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $articles->appends(request()->query())->links() }}
</div>
@endsection
