@extends('admin.layouts.app')

@section('title', 'Admin Learning - Kelola Modul E-Learning')

@section('content')
<div class="min-h-screen bg-slate-50 p-8">
    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tight">📚 Kelola Modul E-Learning</h1>
                <p class="text-slate-500 text-sm mt-1">Tambah, edit, dan hapus modul pembelajaran untuk peserta Layer 1.</p>
            </div>
            <a href="{{ route('admin.learning.create') }}"
               class="inline-flex items-center gap-2 px-5 py-3 bg-lime-500 text-slate-900 font-black text-sm uppercase tracking-widest rounded-xl hover:bg-lime-400 transition shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Modul Baru
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-lime-50 border border-lime-200 text-lime-800 rounded-xl font-bold text-sm">
            ✅ {{ session('success') }}
        </div>
        @endif

        {{-- Tabel Modul --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-900 text-white">
                    <tr>
                        <th class="text-left px-6 py-4 font-bold uppercase tracking-widest text-xs">#</th>
                        <th class="text-left px-6 py-4 font-bold uppercase tracking-widest text-xs">Judul Modul</th>
                        <th class="text-left px-6 py-4 font-bold uppercase tracking-widest text-xs">Tipe Penilaian</th>
                        <th class="text-left px-6 py-4 font-bold uppercase tracking-widest text-xs">Status</th>
                        <th class="text-right px-6 py-4 font-bold uppercase tracking-widest text-xs">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($modules as $i => $module)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 text-slate-400 font-bold">{{ $i + 1 }}</td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-900">{{ $module->title }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ Str::limit($module->description, 60) }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-widest {{ $module->grading_type === 'auto' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $module->grading_type === 'auto' ? '⚡ Otomatis' : '📝 Manual' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-black uppercase tracking-widest {{ $module->is_active ? 'bg-lime-100 text-lime-700' : 'bg-red-100 text-red-600' }}">
                                {{ $module->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.learning.edit', $module->id) }}"
                               class="inline-flex items-center px-3 py-1.5 text-xs font-bold bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.learning.destroy', $module->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus modul ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-bold bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-slate-400">
                            <p class="text-4xl mb-3">📭</p>
                            <p class="font-bold">Belum ada modul. Klik "+ Tambah Modul Baru" untuk memulai!</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('admin.certificates.index') }}" class="px-5 py-3 bg-white border border-slate-200 text-slate-700 font-bold text-sm rounded-xl hover:bg-slate-50 transition">
                🏆 Panel Penilaian & Piagam →
            </a>
        </div>
    </div>
</div>
@endsection
