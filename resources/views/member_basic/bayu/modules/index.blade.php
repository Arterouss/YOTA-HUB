@extends('member_basic.layouts.app')

@section('title', 'E-Learning Modul - Layer 1')
@section('page_header', 'Knowledge Layer: Modul E-Learning')

@section('content')
{{-- 3/31/2026 Edit Bayu - Halaman daftar modul baru, fitur batu Layer 1 --}}
<div class="mb-8">
    <h3 class="text-xl font-bold text-gray-800">Kurikulum Pembelajaran</h3>
    <p class="text-gray-500 text-sm mt-1">Selesaikan setiap modul secara berurutan untuk meningkatkan <span class="font-bold text-lime-600">Competency Score</span> kamu.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
    @forelse($modules as $module)
    @php $pct = $progressMap[$module->id] ?? 0; @endphp
    <a href="{{ route('member.modules.show', $module->slug) }}"
       class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col">

        {{-- Cover Modul --}}
        <div class="relative h-48 bg-gradient-to-br from-slate-800 to-slate-900 overflow-hidden">
            @if($module->thumbnail)
                <img src="{{ asset('storage/' . $module->thumbnail) }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-80 transition" alt="{{ $module->title }}">
            @endif
            <div class="absolute inset-0 flex flex-col justify-end p-5">
                <span class="px-2 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-lime-400 text-slate-900 self-start mb-2">
                    {{ $module->category }}
                </span>
                <h4 class="font-bold text-white text-lg leading-tight">{{ $module->title }}</h4>
            </div>
        </div>

        {{-- Body Kartu --}}
        <div class="p-5 flex flex-col flex-1">
            <p class="text-xs text-gray-500 line-clamp-2 mb-4 flex-1">{{ $module->description }}</p>

            {{-- Info --}}
            <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    {{ $module->materials->count() }} Materi
                </span>
                <span class="flex items-center gap-1 font-bold text-lime-600">
                    +{{ $module->total_xp }} XP
                </span>
            </div>

            {{-- Progress Bar --}}
            <div>
                <div class="flex justify-between items-center mb-1">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Progress</span>
                    <span class="text-[10px] font-black text-lime-600">{{ $pct }}%</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-lime-400 h-2 rounded-full transition-all duration-700" style="width: {{ $pct }}%"></div>
                </div>
            </div>

            <div class="mt-4">
                <span class="inline-block w-full text-center px-4 py-2 bg-slate-900 text-white text-xs font-bold rounded-xl group-hover:bg-lime-500 group-hover:text-slate-900 transition-colors">
                    {{ $pct >= 100 ? '✅ Selesai' : ($pct > 0 ? 'Lanjutkan →' : 'Mulai Belajar →') }}
                </span>
            </div>
        </div>
    </a>

    @empty
    <div class="col-span-full bg-gray-50 p-12 text-center rounded-2xl border-2 border-dashed border-gray-200">
        <p class="text-4xl mb-3">📚</p>
        <p class="font-bold text-gray-600">Belum ada modul yang tersedia.</p>
        <p class="text-sm text-gray-400 mt-1">Modul baru akan segera ditambahkan oleh tim YOTA HUB.</p>
    </div>
    @endforelse
</div>
@endsection
