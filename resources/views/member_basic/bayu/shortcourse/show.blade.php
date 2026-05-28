@extends('member_basic.layouts.app')

@section('title', $course->title)

@section('content')
<div class="max-w-4xl mx-auto pb-20 mt-10">
    <a href="{{ route('member.shortcourse.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 dark:text-slate-400 mb-8 hover:text-lime-600 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        KEMBALI KE KATALOG
    </a>

    @if(session('success'))
        <div class="bg-lime-100 dark:bg-lime-900/30 text-lime-700 dark:text-lime-400 px-4 py-3 rounded-2xl mb-8 font-bold text-center">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 px-4 py-3 rounded-2xl mb-8 font-bold text-center">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white dark:bg-slate-800 rounded-[3rem] p-10 md:p-14 shadow-2xl relative overflow-hidden text-center md:text-left">
        <div class="flex flex-wrap items-center gap-3 mb-6 justify-center md:justify-start">
            <span class="px-4 py-1 rounded-full text-xs font-black uppercase tracking-widest bg-lime-400 text-slate-900 dark:text-white">
                Penyelenggara: {{ $course->organizer }}
            </span>
            <span class="px-4 py-1 rounded-full text-xs font-black uppercase tracking-widest bg-slate-900 text-white">
                {{ $course->modules->count() }} Modul Belajar
            </span>
            @if($course->certificate_available)
                <span class="px-4 py-1 rounded-full text-xs font-black uppercase tracking-widest bg-yellow-400 text-yellow-900">
                    Sertifikat Tersedia
                </span>
            @endif
        </div>

        <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white uppercase leading-none mb-6">
            {{ $course->title }}
        </h1>

        <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-10 max-w-3xl">
            {{ $course->description }}
        </p>

        <div class="bg-slate-50 dark:bg-slate-900 rounded-3xl p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">Status Pendaftaran</p>
                <div class="flex items-center gap-3">
                    <p class="text-2xl font-black text-slate-900 dark:text-white uppercase">{{ $course->status }}</p>
                    <span class="text-sm font-bold text-slate-500 dark:text-slate-400">({{ $course->quota_remaining }} Kursi Sisa)</span>
                </div>
            </div>

            <div>
                <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">Biaya Investasi</p>
                <p class="text-2xl font-black text-lime-600 dark:text-lime-400">
                    {{ $course->course_type === 'free' ? 'GRATIS' : 'Rp ' . number_format($course->price, 0, ',', '.') }}
                </p>
            </div>

            <div class="w-full md:w-auto">
                @if($enrollment)
                    @if($enrollment->payment_status === 'pending')
                        <button class="w-full bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400 px-8 py-4 rounded-xl font-black uppercase tracking-widest cursor-wait">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                MENUNGGU VERIFIKASI ADMIN
                            </span>
                        </button>
                    @else
                        <a href="{{ route('member.shortcourse.learn', $course->id) }}" class="block w-full text-center bg-lime-400 text-slate-900 dark:text-white px-8 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-lime-500 transition-all">
                            LANJUT BELAJAR ({{ $enrollment->progress_percentage }}%)
                        </a>
                    @endif
                @else
                    @if($course->status === 'open' && $course->quota_remaining > 0)
                        <form action="{{ route('member.shortcourse.enroll', $course->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-slate-900 dark:bg-lime-500 text-white dark:text-slate-900 px-8 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-slate-800 dark:hover:bg-lime-400 transition-all">
                                ENROLL KURSUS INI
                            </button>
                        </form>
                    @else
                        <button disabled class="w-full bg-slate-200 dark:bg-slate-800 text-slate-400 dark:text-slate-500 px-8 py-4 rounded-xl font-black uppercase tracking-widest cursor-not-allowed">
                            PENDAFTARAN DITUTUP
                        </button>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
