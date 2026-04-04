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
            $stats = [
                ['label' => 'Total XP', 'value' => '1,250', 'icon' => '⚡', 'color' => 'lime'],
                ['label' => 'Quests Selesai', 'value' => '12', 'icon' => '🏆', 'color' => 'orange'],
                ['label' => 'Yota Coins', 'value' => '450', 'icon' => '🪙', 'color' => 'yellow'],
                ['label' => 'Ranking', 'value' => '#42', 'icon' => '📈', 'color' => 'blue'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="glass-card p-6 rounded-[2.5rem] flex flex-col items-center text-center group hover:scale-105 transition-all cursor-default">
            <span class="text-3xl mb-2 group-hover:animate-bounce">{{ $stat['icon'] }}</span>
            <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">{{ $stat['label'] }}</span>
            <span class="text-2xl font-heading text-slate-900 dark:text-white">{{ $stat['value'] }}</span>
        </div>
        @endforeach
    </div>

    <div class="space-y-6">
        <div class="flex items-center justify-between px-2">
            <h2 class="font-heading text-xl md:text-2xl text-slate-900 dark:text-white uppercase tracking-tight">Active Quests</h2>
            <a href="#" class="text-[10px] font-black text-lime-600 dark:text-lime-400 uppercase tracking-widest hover:underline">Lihat Semua</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="glass-card rounded-[2.5rem] p-6 flex flex-col sm:flex-row gap-6 hover:shadow-2xl hover:shadow-lime-500/10 transition-all border-l-8 border-lime-400">
                <div class="w-full sm:w-32 h-32 rounded-3xl bg-lime-100 dark:bg-lime-900/30 flex items-center justify-center flex-shrink-0">
                    <img src="https://illustrations.popsy.co/lime/web-design.svg" class="w-20 h-20" alt="Course">
                </div>
                <div class="flex-1 space-y-3">
                    <div class="flex justify-between items-start">
                        <span class="text-[9px] font-black text-lime-600 uppercase tracking-widest">Web Development</span>
                        <span class="text-[10px] font-bold text-slate-400">6/10 Modul</span>
                    </div>
                    <h3 class="font-heading text-lg text-slate-900 dark:text-white uppercase leading-none tracking-tight">Mastering Laravel 11</h3>
                    <div class="space-y-2">
                        <div class="w-full h-1.5 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                            <div class="bg-lime-500 h-full" style="width: 60%"></div>
                        </div>
                        <p class="text-[10px] font-bold text-slate-500">Terakhir dipelajari: Controller & Routing</p>
                    </div>
                    <button class="w-full py-2.5 rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-[10px] font-black uppercase tracking-widest transition hover:opacity-80">
                        Lanjut Misi
                    </button>
                </div>
            </div>

            <div class="glass-card rounded-[2.5rem] p-6 flex flex-col sm:flex-row gap-6 hover:shadow-2xl hover:shadow-lime-500/10 transition-all border-l-8 border-blue-400">
                <div class="w-full sm:w-32 h-32 rounded-3xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                    <img src="https://illustrations.popsy.co/lime/data-analysis.svg" class="w-20 h-20" alt="Course">
                </div>
                <div class="flex-1 space-y-3">
                    <div class="flex justify-between items-start">
                        <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest">Artificial Intelligence</span>
                        <span class="text-[10px] font-bold text-slate-400">2/15 Modul</span>
                    </div>
                    <h3 class="font-heading text-lg text-slate-900 dark:text-white uppercase leading-none tracking-tight">AI & Machine Learning</h3>
                    <div class="space-y-2">
                        <div class="w-full h-1.5 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden">
                            <div class="bg-blue-500 h-full" style="width: 15%"></div>
                        </div>
                        <p class="text-[10px] font-bold text-slate-500">Terakhir dipelajari: Introduction to Neural</p>
                    </div>
                    <button class="w-full py-2.5 rounded-xl bg-slate-900 dark:bg-white text-white dark:text-slate-900 text-[10px] font-black uppercase tracking-widest transition hover:opacity-80">
                        Lanjut Misi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('member_basic.partials.secionseminar')
@endsection
