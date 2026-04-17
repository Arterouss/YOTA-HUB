@extends('admin.layouts.app')

@section('title', 'Knowledge Hub Management')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Manajemen Knowledge Hub</h2>
        <p class="mt-1 text-sm text-slate-500">Kelola dan publikasikan artikel, panduan, dan materi literasi.</p>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="{{ route('admin.knowledge.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-bold text-slate-900 bg-lime-400 hover:bg-lime-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tulis Artikel Baru
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold">
    {{ session('success') }}
</div>
@endif

<div class="bg-white dark:bg-slate-900 shadow-sm border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800">
        <thead class="bg-slate-50 dark:bg-slate-800">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Artikel</th>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Kategori</th>
                <th class="px-6 py-4 text-center text-xs font-black text-slate-500 uppercase tracking-wider">Metrik Baca</th>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Status Publikasi</th>
                <th class="px-6 py-4 text-right text-xs font-black text-slate-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 dark:divide-slate-800 bg-white dark:bg-slate-900">
            @forelse($articles as $article)
            <tr>
                <td class="px-6 py-4">
                    <div class="text-sm font-bold text-slate-900 dark:text-white">{{ $article->title }}</div>
                    <div class="text-xs text-slate-500 truncate max-w-xs">{{ $article->summary }}</div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-slate-100 text-slate-800">
                        {{ $article->category->name ?? 'Uncategorized' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="text-sm font-bold text-slate-900 dark:text-white">{{ number_format($article->view_count) }} Kali</div>
                    <div class="text-xs text-slate-500">Timer: {{ $article->reading_time }} Menit</div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full {{ $article->status == 'published' ? 'bg-lime-100 text-lime-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ strtoupper($article->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                    <a href="{{ route('admin.knowledge.edit', $article->id) }}" class="text-blue-600 hover:text-blue-900 dark:hover:text-blue-400">Edit</a>
                    <form action="{{ route('admin.knowledge.destroy', $article->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus artikel ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 dark:hover:text-red-400">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-slate-500 border-2 border-dashed border-slate-200">
                    Belum ada publikasi artikel.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
