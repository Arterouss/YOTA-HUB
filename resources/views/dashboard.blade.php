@extends('member_basic.layouts.app')

@section('content')
<div class="space-y-10 pb-10">

    <div class="relative glass-card rounded-[3rem] p-8 md:p-12 overflow-hidden border-none bg-gradient-to-br from-lime-400/20 to-emerald-500/10 dark:from-lime-500/10 dark:to-slate-900">
        <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="space-y-4 text-center lg:text-left">
                <div class="inline-block px-4 py-1 rounded-full bg-white dark:bg-slate-800 shadow-sm">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-lime-600">Adventurer Level 1</span>
                </div>
                <h1 class="font-heading text-4xl md:text-5xl text-slate-900 dark:text-white leading-tight">
                    SELAMAT DATANG <br> <span class="text-lime-600 dark:text-lime-400 uppercase">{{ Auth::user()->name }}!</span>
                </h1>
                <p class="text-sm font-bold text-slate-600 dark:text-lime-100/60 max-w-md leading-relaxed">
                    Siap untuk melanjutkan petualangan hari ini? Kamu hanya butuh <span class="text-slate-900 dark:text-white font-black">250 XP</span> lagi untuk naik ke Level 2!
                </p>
                <div class="pt-4 flex flex-wrap justify-center lg:justify-start gap-4">
                    <button class="btn-lemon px-8 py-3 rounded-2xl font-heading text-xs uppercase tracking-widest">
                        Lanjut Belajar
                    </button>
                    <button class="bg-white/50 dark:bg-slate-800/50 backdrop-blur-md px-8 py-3 rounded-2xl font-bold text-xs text-slate-900 dark:text-white border border-white dark:border-slate-700 transition hover:bg-white dark:hover:bg-slate-800">
                        Lihat Roadmap
                    </button>
                </div>
            </div>

            <div class="w-48 md:w-64 transform hover:scale-110 transition duration-700">
                <img src="https://illustrations.popsy.co/lime/student-going-to-school.svg" alt="Mascot">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
        @php
        $dashboardStats = [
        ['label' => 'Total XP', 'value' => number_format($stats['innovation_points']), 'icon' => '⚡', 'color' => 'lime'],
        ['label' => 'Quests Selesai', 'value' => $stats['courses_completed'], 'icon' => '🏆', 'color' => 'orange'],
        ['label' => 'Yota Coins', 'value' => '0', 'icon' => '🪙', 'color' => 'yellow'],
        ['label' => 'Ranking', 'value' => '#-', 'icon' => '📈', 'color' => 'blue'],
        ];
        @endphp

        @foreach($dashboardStats as $stat)
        <div class="glass-card p-6 rounded-[2.5rem] flex flex-col items-center text-center group hover:scale-105 transition-all cursor-default">
            <span class="text-3xl mb-2 group-hover:animate-bounce">{{ $stat['icon'] }}</span>
            <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ $stat['label'] }}</span>
            <span class="text-2xl font-heading text-slate-900 dark:text-white">{{ $stat['value'] }}</span>
        </div>
        @endforeach
    </div>

    <div class="space-y-6">
        <div class="flex items-center justify-between px-2">
            <h2 class="font-heading text-xl md:text-2xl text-slate-900 dark:text-white uppercase tracking-tight">Misi Seminar Saya</h2>
            <a href="{{ route('member.seminars.index') }}" class="text-[10px] font-black text-lime-600 dark:text-lime-400 uppercase tracking-widest hover:underline">Explore Seminar</a>
        </div>

        <div class="grid grid-cols-1 gap-4">
            @forelse($joinedSeminars as $seminar)
            <div class="glass-card rounded-[2rem] p-6 flex flex-col md:flex-row items-center gap-6 border-l-8 {{ $seminar->pivot->payment_status === 'paid' ? 'border-lime-400' : 'border-orange-400' }}">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-[9px] font-black px-2 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-slate-500 uppercase">{{ $seminar->seminar_type }}</span>
                        <h3 class="font-heading text-lg text-slate-900 dark:text-white uppercase leading-none">{{ $seminar->title }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4">
                        <div>
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Pembayaran</p>
                            <p class="text-xs font-bold {{ $seminar->pivot->payment_status === 'paid' ? 'text-lime-600' : 'text-orange-500' }}">{{ strtoupper($seminar->pivot->payment_status ?? 'pending') }}</p>
                        </div>
                        <div>
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Presensi</p>
                            <p class="text-xs font-bold">{{ $seminar->pivot->attendance_status ? 'HADIR ✅' : 'ABSEN ❌' }}</p>
                        </div>
                        <div>
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Feedback</p>
                            <p class="text-xs font-bold">{{ $seminar->pivot->feedback_status ? 'DONE ✅' : 'PENDING ⏳' }}</p>
                        </div>
                        <div>
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Quiz</p>
                            <p class="text-xs font-bold">{{ $seminar->pivot->quiz_status ? 'DONE ✅' : 'PENDING ⏳' }}</p>
                        </div>
                        <div>
                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Poin Didapat</p>
                            <p class="text-xs font-black text-lime-600">{{ $seminar->pivot->point_earned }} PTS</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('member.seminars.show', $seminar->slug) }}" class="px-6 py-3 rounded-xl bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest hover:bg-lime-500 hover:text-slate-900 transition-all">
                    Detail Misi
                </a>
            </div>
            @empty
            <div class="glass-card rounded-[2rem] p-10 text-center border-2 border-dashed border-slate-200">
                <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Kamu belum mengikuti seminar apapun.</p>
                <a href="{{ route('member.seminars.index') }}" class="mt-4 inline-block text-lime-600 font-black text-xs uppercase tracking-[0.2em]">Cari Seminar Sekarang &rarr;</a>
            </div>
            @endforelse
        </div>
    </div>

    <!-- 4/24/2026 Edit Bayu - Short Course & Knowledge Hub Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Short Course Progress -->
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between px-2">
                <h2 class="font-heading text-xl md:text-2xl text-slate-900 dark:text-white uppercase tracking-tight">Active Short Courses</h2>
                <a href="{{ route('member.shortcourse.index') }}" class="text-[10px] font-black text-lime-600 dark:text-lime-400 uppercase tracking-widest hover:underline">Lihat Katalog</a>
            </div>

            <div class="grid grid-cols-1 gap-4">
                @forelse($enrolledCourses as $enrollment)
                <div class="glass-card rounded-[2rem] p-6 flex flex-col sm:flex-row items-center gap-6 border-l-8 {{ $enrollment->status === 'completed' ? 'border-emerald-400' : 'border-blue-400' }}">
                    <div class="flex-1 w-full space-y-3">
                        <div class="flex justify-between items-start">
                            <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest">{{ $enrollment->course->course_type }}</span>
                            <span class="text-[10px] font-bold text-slate-400">{{ $enrollment->status === 'completed' ? 'LULUS' : 'ON PROGRESS' }}</span>
                        </div>
                        <h3 class="font-heading text-lg text-slate-900 dark:text-white uppercase leading-none tracking-tight">{{ $enrollment->course->title }}</h3>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between text-[10px] font-bold">
                                <span class="text-slate-500">Progress</span>
                                <span class="text-slate-900 dark:text-white">{{ $enrollment->progress_percentage }}%</span>
                            </div>
                            <div class="w-full h-1.5 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                                <div class="bg-blue-500 h-full transition-all duration-1000" style="width: {{ $enrollment->progress_percentage }}%"></div>
                            </div>
                        </div>
                        
                        @if($enrollment->status === 'completed')
                        <a href="{{ route('member.shortcourse.generate_certificate', $enrollment->course->id) }}" class="inline-block mt-2 px-4 py-2 bg-emerald-100 text-emerald-700 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-200 transition">
                            Unduh Sertifikat 🎓
                        </a>
                        @endif
                    </div>
                    <a href="{{ route('member.shortcourse.learn', $enrollment->course->id) }}" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest hover:bg-blue-500 transition-all text-center">
                        Lanjut Belajar
                    </a>
                </div>
                @empty
                <div class="glass-card rounded-[2rem] p-10 text-center border-2 border-dashed border-slate-200">
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Belum ada kursus aktif.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Knowledge Hub Literacy Stats -->
        <div class="space-y-6">
            <div class="flex items-center justify-between px-2">
                <h2 class="font-heading text-xl md:text-2xl text-slate-900 dark:text-white uppercase tracking-tight">Literacy Stats</h2>
                <a href="{{ route('member.knowledge.index') }}" class="text-[10px] font-black text-lime-600 dark:text-lime-400 uppercase tracking-widest hover:underline">Baca Artikel</a>
            </div>
            
            <div class="glass-card rounded-[2rem] p-8 text-center space-y-6 bg-gradient-to-b from-white to-slate-50 dark:from-slate-800 dark:to-slate-900">
                <div class="w-24 h-24 mx-auto bg-lime-100 dark:bg-lime-900/30 rounded-full flex items-center justify-center">
                    <span class="text-4xl">📚</span>
                </div>
                
                <div class="space-y-1">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Artikel Dibaca</p>
                    <p class="text-4xl font-heading text-slate-900 dark:text-white">{{ $stats['articles_read'] }}</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-100 dark:border-slate-700/50">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Poin Literasi</p>
                        <p class="text-lg font-bold text-lime-600">{{ $stats['literacy_points'] }} PTS</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Topik Favorit</p>
                        <p class="text-xs font-bold text-slate-700 dark:text-slate-300 line-clamp-2">{{ $stats['favorite_topic'] }}</p>
                    </div>
                </div>
                
                <a href="{{ route('member.knowledge.index') }}" class="block w-full py-3 rounded-xl border-2 border-slate-900 dark:border-white text-slate-900 dark:text-white text-[10px] font-black uppercase tracking-widest hover:bg-slate-900 hover:text-white dark:hover:bg-white dark:hover:text-slate-900 transition-all">
                    Eksplor Knowledge Hub
                </a>
            </div>
        </div>
        
    </div>
</div>

@include('member_basic.partials.secionseminar')
@endsection