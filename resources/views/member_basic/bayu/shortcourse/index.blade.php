@extends('member_basic.layouts.app')

@section('title', 'Short Course - Layer 1')
@section('page_header', 'Knowledge Layer: Short Course & Multi-Module')

@section('content')
<div class="mb-8">
    <h3 class="text-xl font-bold text-gray-800">Eksplorasi Pembelajaran</h3>
    <p class="text-gray-600">Pilih program kursus bersertifikat untuk mengembangkan keahlian spesifik Anda.</p>
</div>

@if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 px-4 py-3 border border-emerald-200 rounded-xl mb-6">
        <span class="font-bold">{{ session('success') }}</span>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($courses as $course)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col">
        <div class="relative">
            <div class="h-48 w-full bg-slate-200 flex items-center justify-center text-slate-400 font-bold">
                {{ $course->organizer }}
            </div>
            <div class="absolute top-4 left-4">
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $course->course_type == 'free' ? 'bg-emerald-600 text-white' : 'bg-blue-600 text-white' }}">
                    {{ $course->course_type == 'free' ? 'Gratis' : 'Rp' . number_format($course->price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="p-6 flex flex-col flex-1">
            <div class="flex items-center text-xs text-gray-500 mb-2 gap-3">
                <span class="flex items-center gap-1">
                    Sisa Kuota: {{ $course->quota_remaining }}
                </span>
                <span class="flex items-center gap-1">
                    Modul: {{ $course->modules->count() ?? 0 }} Bab
                </span>
            </div>

            <h4 class="font-bold text-lg text-gray-900 leading-tight mb-2">{{ $course->title }}</h4>
            <p class="text-sm text-gray-500 line-clamp-2 mb-6 flex-1">{{ $course->description }}</p>

            <a href="{{ route('member.shortcourse.show', $course->id) }}" class="inline-flex items-center justify-center w-full px-4 py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition">
                Buka Kursus
            </a>
        </div>
    </div>
    @empty
    <div class="col-span-full bg-gray-50 p-12 text-center rounded-2xl border-2 border-dashed border-gray-200">
        <p class="text-gray-500">Belum ada kursus yang tersedia saat ini.</p>
    </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $courses->links() }}
</div>
@endsection
