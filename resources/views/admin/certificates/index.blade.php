@extends('admin.layouts.app')

@section('title', 'Panel Penilaian & Piagam')

@section('content')
<div class="min-h-screen bg-slate-50 p-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tight">🏆 Panel Penilaian & Piagam</h1>
                <p class="text-slate-500 text-sm mt-1">Pilih modul untuk melihat daftar mahasiswa yang perlu dinilai.</p>
            </div>
            <a href="{{ route('admin.learning.index') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-700 font-bold text-sm rounded-xl hover:bg-slate-50 transition">
                ← Kelola Modul
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-lime-50 border border-lime-200 text-lime-800 rounded-xl font-bold text-sm">✅ {{ session('success') }}</div>
        @endif

        <div class="grid gap-6">
            @forelse($modules as $module)
            @php
                $pending = $module->users->filter(fn($u) => !$u->pivot->certificate_code)->count();
            @endphp
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center text-2xl">📚</div>
                    <div>
                        <h3 class="font-black text-slate-900">{{ $module->title }}</h3>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="text-xs font-bold {{ $module->grading_type === 'manual' ? 'text-amber-600' : 'text-blue-600' }}">
                                {{ $module->grading_type === 'manual' ? '📝 Manual (Submit Tugas)' : '⚡ Otomatis' }}
                            </span>
                            <span class="text-xs text-slate-400">·</span>
                            <span class="text-xs font-bold text-slate-600">{{ $module->users->count() }} peserta terdaftar</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    @if($pending > 0)
                    <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-black rounded-full">
                        {{ $pending }} menunggu penilaian
                    </span>
                    @else
                    <span class="px-3 py-1 bg-lime-100 text-lime-700 text-xs font-black rounded-full">✅ Semua dinilai</span>
                    @endif
                    <a href="{{ route('admin.certificates.show', $module->id) }}"
                       class="px-4 py-2 bg-slate-900 text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-lime-500 hover:text-slate-900 transition">
                        Nilai Peserta →
                    </a>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-2xl p-16 text-center border border-slate-100">
                <p class="text-4xl mb-3">📭</p>
                <p class="font-bold text-slate-600">Belum ada modul E-Learning. <a href="{{ route('admin.learning.create') }}" class="text-lime-600 underline">Tambah modul sekarang →</a></p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
