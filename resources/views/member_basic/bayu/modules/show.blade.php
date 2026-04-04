@extends('member_basic.layouts.app')

@section('title', $module->title . ' - E-Learning')

@section('content')
{{-- 3/31/2026 Edit Bayu - Halaman detail modul: daftar materi dan player video/artikel --}}
<div class="max-w-6xl mx-auto pb-20">

    {{-- Tombol Kembali --}}
    <a href="{{ route('member.modules.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 mb-8 hover:text-lime-600 transition group">
        <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        KEMBALI KE MODUL
    </a>

    <div class="lg:grid lg:grid-cols-3 lg:gap-10">

        {{-- SIDEBAR KIRI: Daftar Materi --}}
        <div class="lg:col-span-1 mb-8 lg:mb-0">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                <div class="p-5 border-b border-gray-100 bg-slate-900 text-white">
                    <p class="text-[10px] font-black uppercase tracking-widest text-lime-400 mb-1">Modul</p>
                    <h2 class="text-lg font-bold leading-tight">{{ $module->title }}</h2>

                    {{-- Progress Bar Global Modul --}}
                    <div class="mt-4">
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-slate-400 font-bold">Competency Score</span>
                            <span class="text-lime-400 font-black">{{ $progress }}%</span>
                        </div>
                        <div class="w-full bg-slate-700 rounded-full h-2">
                            <div class="bg-lime-400 h-2 rounded-full transition-all duration-700" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Daftar Materi --}}
                <ul class="divide-y divide-gray-50">
                    @forelse($module->materials as $index => $mat)
                    @php $isDone = in_array($mat->id, $completedIds); @endphp
                    <li>
                        <a href="{{ route('member.modules.material', $mat->id) }}"
                           class="flex items-center gap-4 p-4 hover:bg-lime-50 transition-colors {{ $isDone ? 'opacity-70' : '' }}">
                            {{-- Nomor/Status --}}
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 text-xs font-black
                                {{ $isDone ? 'bg-lime-400 text-slate-900' : 'bg-slate-100 text-slate-500' }}">
                                {{ $isDone ? '✓' : ($index + 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-slate-800 truncate">{{ $mat->title }}</p>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-[10px] text-slate-400 uppercase">
                                        {{ $mat->type === 'video' ? '🎬 Video' : ($mat->type === 'pdf' ? '📄 PDF' : '📝 Artikel') }}
                                    </span>
                                    @if($mat->duration_minutes)
                                    <span class="text-[10px] text-slate-400">· {{ $mat->duration_minutes }} menit</span>
                                    @endif
                                </div>
                            </div>
                            <span class="text-[10px] font-black text-lime-600 flex-shrink-0">+{{ $mat->xp_reward }} XP</span>
                        </a>
                    </li>
                    @empty
                    <li class="p-6 text-center text-sm text-gray-400">Belum ada materi di modul ini.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- KONTEN KANAN: Preview Modul --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <h1 class="text-2xl font-bold text-slate-900 mb-4">{{ $module->title }}</h1>
                <p class="text-gray-500 leading-relaxed">{{ $module->description }}</p>

                <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <div class="bg-slate-50 rounded-xl p-4 text-center">
                        <p class="text-2xl font-black text-slate-900">{{ $module->materials->count() }}</p>
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Total Materi</p>
                    </div>
                    <div class="bg-lime-50 rounded-xl p-4 text-center">
                        <p class="text-2xl font-black text-lime-600">{{ count($completedIds) }}</p>
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Selesai</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 text-center">
                        <p class="text-2xl font-black text-slate-900">+{{ $module->total_xp }}</p>
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Total XP</p>
                    </div>
                </div>

                @if($progress >= 100)
                <div class="mt-8 p-5 bg-lime-400 rounded-2xl text-center text-slate-900">
                    <p class="text-3xl mb-2">🏆</p>
                    <p class="font-black text-xl uppercase tracking-wider">Modul Selesai!</p>
                    <p class="text-sm font-bold mt-1">Kamu telah menyelesaikan semua materi di modul ini.</p>
                </div>
                @else
                <div class="mt-8 p-5 bg-slate-50 rounded-2xl">
                    <p class="text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Langkah Berikutnya</p>
                    <p class="text-sm text-slate-700">Pilih salah satu materi di sebelah kiri untuk mulai atau melanjutkan pembelajaran kamu.</p>
                    @if($module->materials->isNotEmpty())
                    @php
                        $nextMaterial = $module->materials->firstWhere(fn($m) => !in_array($m->id, $completedIds));
                    @endphp
                    @if($nextMaterial)
                    <a href="{{ route('member.modules.material', $nextMaterial->id) }}"
                       class="inline-flex items-center gap-2 mt-4 px-6 py-3 bg-slate-900 text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-lime-500 hover:text-slate-900 transition-all">
                        Mulai Materi Berikutnya →
                    </a>
                    @endif
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
