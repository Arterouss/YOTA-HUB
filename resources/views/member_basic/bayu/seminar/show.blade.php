@extends('member_basic.layouts.app')

@section('title', $seminar->title)

@section('content')
<div class="max-w-6xl mx-auto pb-20">
    {{-- Tombol Kembali --}}
    <a href="{{ route('member.seminars.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 mb-8 hover:text-lime-600 transition-colors group">
        <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        KEMBALI KE EXPLORE
    </a>

    <div class="glass-card rounded-[3rem] overflow-hidden shadow-2xl border-none">
        <div class="lg:flex">
            {{-- Bagian Kiri: Poster --}}
            <div class="lg:w-2/5 p-6">
                <div class="sticky top-6">
                    <img src="{{ $seminar->poster_path ? asset('storage/' . $seminar->poster_path) : 'https://via.placeholder.com/800x1000' }}"
                         class="w-full aspect-[3/4] object-cover rounded-[2rem] shadow-2xl"
                         alt="{{ $seminar->title }}">

                    {{-- Badge Status Mobile --}}
                    <div class="mt-6 flex flex-wrap gap-2">
                        <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest bg-lime-400 text-slate-900">
                            {{ $seminar->type }} Event
                        </span>
                        <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest {{ $seminar->status === 'Open' ? 'bg-emerald-400 text-emerald-900' : ($seminar->status === 'Full' ? 'bg-red-500 text-white' : 'bg-slate-500 text-white') }}">
                            Status: {{ $seminar->status }}
                        </span>
                        <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest bg-blue-400 text-blue-900">
                            Tipe: {{ $seminar->seminar_type == 'free' ? 'Gratis' : 'Berbayar (' . 'Rp' . number_format($seminar->price, 0, ',', '.') . ')' }}
                        </span>
                        <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest bg-slate-900 text-white">
                            Kuota Tersisa: {{ $seminar->quota_remaining }} / {{ $seminar->quota_total }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Bagian Kanan: Info & Dynamic Links --}}
            <div class="lg:w-3/5 p-8 md:p-12 flex flex-col justify-between bg-white/50 dark:bg-slate-900/50">
                <div>
                    {{-- Header Acara --}}
                    <div class="space-y-2">
                        <p class="text-[10px] font-black text-lime-600 dark:text-lime-400 uppercase tracking-[0.3em]">Quest Detail</p>
                        <h1 class="text-3xl md:text-4xl font-heading text-slate-900 dark:text-white leading-none uppercase">{{ $seminar->title }}</h1>

                        @if($seminar->speaker)
                        <div class="flex items-center gap-2 mt-4 text-slate-600 dark:text-slate-400">
                            <span class="text-xs font-bold uppercase tracking-widest">Narasumber:</span>
                            <span class="text-sm font-black text-slate-900 dark:text-white">{{ $seminar->speaker }}</span>
                        </div>
                        @endif
                    </div>

                    {{-- Info Waktu & Lokasi --}}
                    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-lime-100 dark:border-slate-800">
                            <div class="p-3 bg-lime-100 dark:bg-lime-900/30 rounded-xl text-lime-600 dark:text-lime-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[9px] text-slate-400 uppercase font-black tracking-widest">Waktu Misi & Pembicara</p>
                                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $seminar->event_date->format('l, d F Y') }} <span class="text-slate-400 text-xs font-normal">({{ $seminar->event_date->format('H:i') }} WIB)</span></p>
                                @if($seminar->speaker)
                                <p class="text-xs text-lime-600 dark:text-lime-400 font-black mt-1 uppercase tracking-widest flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $seminar->speaker }}
                                </p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-white dark:bg-slate-800 shadow-sm border border-lime-100 dark:border-slate-800">
                            <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl text-blue-600 dark:text-blue-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[9px] text-slate-400 uppercase font-black tracking-widest">Titik Kumpul</p>
                                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $seminar->location }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mt-10">
                        <h4 class="font-heading text-sm text-slate-900 dark:text-white mb-4 uppercase tracking-widest">Informasi Misi</h4>
                        <div class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed space-y-4">
                            {!! nl2br(e($seminar->description)) !!}
                        </div>
                    </div>

                    {{-- FITUR EXTRA (Dynamic Links) --}}

{{-- Deskripsi --}}
<div class="mt-10">
    <h4 class="font-heading text-sm text-slate-900 dark:text-white mb-4 uppercase tracking-widest">Informasi Misi</h4>
    <div class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed space-y-4">
        {!! nl2br(e($seminar->description)) !!}
    </div>
</div>

{{-- STATUS POIN & XP (Hanya muncul jika sudah daftar) --}}
@if($isRegistered)
<div class="mt-8 p-4 bg-lime-50 dark:bg-lime-900/10 border-2 border-dashed border-lime-400 rounded-3xl flex justify-between items-center flex-wrap gap-4">
    <div>
        <p class="text-[9px] font-black uppercase text-lime-600 tracking-[0.2em]">Kesiapan Peserta</p>
        <p class="text-lg font-black text-slate-900 dark:text-white uppercase">Misi Aktif</p>
        <div class="flex gap-2 mt-2">
            <span class="text-[10px] font-bold px-2 py-1 rounded bg-white dark:bg-slate-800 text-slate-600 border border-slate-200">Terdaftar ✅</span>
            <span class="text-[10px] font-bold px-2 py-1 rounded bg-white dark:bg-slate-800 border {{ ($userPivot->pivot->payment_status ?? '') === 'paid' || $seminar->seminar_type === 'free' ? 'border-lime-200 text-lime-600' : 'border-orange-200 text-orange-500' }}">Pembayaran: {{ strtoupper($userPivot->pivot->payment_status ?? 'pending') }} {{ ($userPivot->pivot->payment_status ?? '') === 'paid' || $seminar->seminar_type === 'free' ? '✅' : '⏳' }}</span>
        </div>
    </div>
    <div class="text-right">
        <p class="text-[9px] font-black uppercase text-slate-400 tracking-[0.2em]">Poin Gamifikasi</p>
        <!-- 3/31/2026 Edit Bayu - Mengganti query berulang di blade dengan $userPivot dari controller (Optimization) -->
        <p class="text-2xl font-black text-lime-600">{{ $userPivot->pivot->point_earned ?? 0 }} <span class="text-xs">PTS</span></p>
    </div>
    
    @if($isFinished)
    <div class="w-full mt-2 pt-4 border-t border-dashed border-lime-200">
        <p class="text-[10px] text-slate-500 font-bold uppercase mb-2">Checklist Pencapaian Akhir:</p>
        <div class="flex flex-wrap items-center gap-4 text-xs font-bold text-slate-700">
            <span>Kehadiran: {!! ($userPivot->pivot->attendance_status ?? false) ? '<span class="text-lime-600">✅</span>' : '<span class="text-red-500">❌ (-30)</span>' !!}</span>
            <span>Feedback: {!! ($userPivot->pivot->feedback_status ?? false) ? '<span class="text-lime-600">✅</span>' : '<span class="text-red-500">❌ (-30)</span>' !!}</span>
            <span>Kuis: {!! ($userPivot->pivot->quiz_status ?? false) ? '<span class="text-lime-600">✅</span>' : '<span class="text-red-500">❌ (-40)</span>' !!}</span>
        </div>
    </div>
    @endif
</div>
@endif

{{-- FITUR EXTRA (Dynamic Links) --}}
<div class="mt-10 space-y-4">
    <div class="flex items-center justify-between">
        <h4 class="font-heading text-sm text-slate-900 dark:text-white uppercase tracking-widest">Resources & Links</h4>
        @if(!$hasFullAccess)
            <span class="text-[9px] font-bold text-orange-500 bg-orange-100 px-2 py-1 rounded-md">🔒 TERKUNCI</span>
        @endif
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        {{-- Meeting Link --}}
        @if($seminar->meeting_link)
            @if($hasFullAccess)
                <a href="{{ $seminar->meeting_link }}" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800 hover:scale-105 transition-transform">
                    <span class="text-xl">📹</span>
                    <span class="text-[10px] font-black uppercase">Virtual Meeting Room</span>
                </a>
            @else
                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 text-gray-400 border border-gray-100 cursor-not-allowed grayscale">
                    <span class="text-xl">🔒</span>
                    <span class="text-[10px] font-black uppercase">Meeting Room (Terkunci)</span>
                </div>
            @endif
        @endif

        {{-- Quiz & Game --}}
        @if($seminar->quiz_link || $seminar->game_link)
            @if($hasFullAccess)
                <a href="{{ $seminar->quiz_link ?? $seminar->game_link }}" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400 border border-orange-100 dark:border-orange-800 hover:scale-105 transition-transform">
                    <span class="text-xl">🎮</span>
                    <span class="text-[10px] font-black uppercase">Interactive Quiz/Game</span>
                </a>
            @else
                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 text-gray-400 border border-gray-100 cursor-not-allowed grayscale">
                    <span class="text-xl">🔒</span>
                    <span class="text-[10px] font-black uppercase">Quiz (Terkunci)</span>
                </div>
            @endif
        @endif

        {{-- Record / Tayangan Ulang --}}
        @if($seminar->recording_link)
            @if($hasFullAccess)
                <a href="{{ $seminar->recording_link }}" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-800 hover:scale-105 transition-transform">
                    <span class="text-xl">🎬</span>
                    <span class="text-[10px] font-black uppercase">Watch Recording</span>
                </a>
            @else
                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 text-gray-400 border border-gray-100 cursor-not-allowed grayscale">
                    <span class="text-xl">🔒</span>
                    <span class="text-[10px] font-black uppercase">Record (Terkunci)</span>
                </div>
            @endif
        @endif

        {{-- Attachment --}}
        @if($seminar->attachment_link)
            @if($hasFullAccess)
                <a href="{{ $seminar->attachment_link }}" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 border border-purple-100 dark:border-purple-800 hover:scale-105 transition-transform">
                    <span class="text-xl">📚</span>
                    <span class="text-[10px] font-black uppercase">Download Materi</span>
                </a>
            @else
                <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 text-gray-400 border border-gray-100 cursor-not-allowed grayscale">
                    <span class="text-xl">🔒</span>
                    <span class="text-[10px] font-black uppercase">Materi (Terkunci)</span>
                </div>
            @endif
        @endif
    </div>
</div>

{{-- Action Button --}}
<div class="mt-12 border-t border-slate-100 dark:border-slate-800 pt-8">
    <div class="flex flex-col sm:flex-row gap-4">
        @if(!$isRegistered && !$isFinished)
            {{-- Tombol Daftar Jika Belum Terdaftar & Event Belum Selesai --}}
            <form action="{{ route('member.seminars.register', $seminar->id) }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full {{ $seminar->status === 'Full' || $seminar->status === 'Closed' ? 'bg-slate-300 text-slate-500 cursor-not-allowed' : 'bg-lime-400 text-slate-900 hover:bg-lime-500 active:scale-95 shadow-xl shadow-lime-400/20' }} py-4 rounded-2xl font-heading text-xs tracking-[0.2em] uppercase flex items-center justify-center gap-3 transition-all" {{ $seminar->status === 'Full' || $seminar->status === 'Closed' ? 'disabled' : '' }}>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    {{ $seminar->status === 'Full' ? 'KUOTA HABIS' : ($seminar->status === 'Closed' ? 'PENDAFTARAN DITUTUP' : 'SAYA SETUJU & AMBIL MISI') }}
                </button>
            </form>
        @elseif($isRegistered && !$isFinished)
            {{-- Tombol Jika Sudah Terdaftar (Sudah Terbuka) --}}
            <button class="flex-1 bg-lime-100 text-lime-700 py-4 rounded-2xl font-heading text-xs tracking-[0.2em] uppercase flex items-center justify-center gap-3 cursor-default">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                KAMU SUDAH TERDAFTAR
            </button>
        @elseif($isFinished)
            {{-- Jika Sudah Selesai (Akses Publik) --}}
            <button class="flex-1 bg-slate-100 text-slate-500 py-4 rounded-2xl font-heading text-xs tracking-[0.2em] uppercase flex items-center justify-center gap-3 cursor-default">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                MISI SELESAI (ARSIP TERBUKA)
            </button>
        @endif

        @if($hasFullAccess && $seminar->evaluation_link)
            <a href="{{ $seminar->evaluation_link }}" target="_blank" class="flex-1 bg-slate-900 dark:bg-slate-700 text-white py-4 rounded-2xl font-heading text-xs tracking-[0.2em] uppercase text-center flex items-center justify-center gap-3 hover:bg-slate-800 transition-all">
                KLAIM XP & EVALUASI
            </a>
        @endif
    </div>

    <p class="text-center text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-6">
        @if($isFinished)
            Misi ini telah berakhir. Resource dibuka untuk umum sebagai Knowledge Base YOTA HUB.
        @else
            Dapatkan +50 XP & Badge Knowledge Pioneer setelah menyelesaikan evaluasi misi ini.
        @endif
    </p>
</div>
            </div>
        </div>
    </div>
</div>
{{-- Form Klaim Poin (Hanya muncul jika sudah daftar) --}}
<!-- 3/31/2026 Edit Bayu - Membaca is_attended dari instance $userPivot untuk menghindari N+1 problem di Blade -->
@if($isRegistered && !($userPivot->pivot->attendance_status ?? false))
<div class="mt-12 bg-slate-900 rounded-[2rem] p-8 text-white">
    <h3 class="font-heading text-xl mb-6">KLAIM KOMPETENSI & EVALUASI</h3>

    <form action="{{ route('member.seminars.claim', $seminar->id) }}" method="POST">
        @csrf

        {{-- Section Kuis --}}
        <div class="space-y-8 mb-10">
            @foreach($seminar->quizzes as $index => $quiz)
            <div class="space-y-4">
                <p class="text-sm font-bold">{{ $index + 1 }}. {{ $quiz->question }}</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach(['A' => $quiz->option_a, 'B' => $quiz->option_b, 'C' => $quiz->option_c, 'D' => $quiz->option_d] as $key => $val)
                    <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-700 hover:bg-slate-800 cursor-pointer">
                        <input type="radio" name="answers[{{ $quiz->id }}]" value="{{ $key }}" class="text-lime-400">
                        <span class="text-xs uppercase">{{ $key }}. {{ $val }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        {{-- Section Rating --}}
        <div class="border-t border-slate-700 pt-8">
            <p class="text-sm font-bold mb-4 uppercase tracking-widest text-lime-400">Evaluasi Pembelajaran</p>
            <input type="number" name="rating" min="1" max="5" placeholder="Rating 1-5" class="bg-slate-800 border-none rounded-lg text-white w-full mb-4">
            <textarea name="message" placeholder="Apa yang kamu pelajari dari misi ini?" class="bg-slate-800 border-none rounded-xl text-white w-full h-32"></textarea>
        </div>

        <button type="submit" class="w-full mt-6 bg-lime-400 text-slate-900 py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-lime-500 transition-all">
            KIRIM EVALUASI & KLAIM XP
        </button>
    </form>
</div>
@endif
@endsection
