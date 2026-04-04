@extends('member_basic.layouts.app')

@section('title', 'Seminar & Event - Layer 1')
@section('page_header', 'Knowledge Layer: Seminar & Webinar')

@section('content')
<div class="mb-8">
    <h3 class="text-xl font-bold text-gray-800">Eksplorasi Pengetahuan</h3>
    <p class="text-gray-600">Pilih seminar atau webinar untuk membangun kompetensi dasar sebelum masuk ke tahap riset.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($seminars as $seminar)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="relative">
            <img src="{{ $seminar->poster_path ? asset('storage/' . $seminar->poster_path) : 'https://via.placeholder.com/600x400' }}" class="h-56 w-full object-cover" alt="{{ $seminar->title }}">
            <div class="absolute top-4 left-4">
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $seminar->type == 'online' ? 'bg-blue-600 text-white' : 'bg-emerald-600 text-white' }}">
                    {{ $seminar->type }}
                </span>
            </div>
        </div>

        <div class="p-6">
            <div class="flex items-center text-xs text-gray-500 mb-2 gap-3">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ \Carbon\Carbon::parse($seminar->event_date)->format('d M Y') }}
                </span>
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Sisa Kuota: {{ $seminar->quota }}
                </span>
            </div>

            <h4 class="font-bold text-lg text-gray-900 leading-tight mb-3 line-clamp-2 h-12">{{ $seminar->title }}</h4>

            <a href="{{ route('member.seminars.show', $seminar->slug) }}" class="inline-flex items-center justify-center w-full px-4 py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition">
                Daftar Sekarang
            </a>
        </div>
    </div>
    @empty
    <div class="col-span-full bg-gray-50 p-12 text-center rounded-2xl border-2 border-dashed border-gray-200">
        <p class="text-gray-500">Belum ada seminar yang tersedia saat ini.</p>
    </div>
    @endforelse
</div>
@endsection
