@extends('admin.layouts.app')

@section('title', 'Kelola E-Learning (LMS)')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Manajemen E-Learning</h2>
        <p class="mt-1 text-sm text-slate-500">Kelola daftar Short Course dan modul pembelajarannya.</p>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="{{ route('admin.learning.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-bold text-slate-900 bg-lime-400 hover:bg-lime-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Kursus Baru
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
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Info Kelas</th>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Tipe & Harga</th>
                <th class="px-6 py-4 text-center text-xs font-black text-slate-500 uppercase tracking-wider">Kuota</th>
                <th class="px-6 py-4 text-center text-xs font-black text-slate-500 uppercase tracking-wider">Bab Modul</th>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-right text-xs font-black text-slate-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 dark:divide-slate-800 bg-white dark:bg-slate-900">
            @forelse($courses as $course)
            <tr>
                <td class="px-6 py-4">
                    <div class="text-sm font-bold text-slate-900 dark:text-white">{{ $course->title }}</div>
                    <div class="text-xs text-slate-500">{{ $course->organizer }}</div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full {{ $course->course_type == 'free' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ strtoupper($course->course_type) }}
                    </span>
                    <div class="text-xs font-bold text-slate-500 mt-1">Rp{{ number_format($course->price, 0, ',', '.') }}</div>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="text-sm text-slate-900 dark:text-white font-bold">{{ $course->quota_total - $course->quota_remaining }} / {{ $course->quota_total }}</div>
                </td>
                <td class="px-6 py-4 text-center">
                    <a href="{{ route('admin.learning.modules.index', $course->id) }}" class="inline-flex items-center px-3 py-1 bg-slate-100 dark:bg-slate-800 hover:bg-lime-100 dark:hover:bg-lime-900/30 text-slate-700 dark:text-lime-400 rounded-lg text-xs font-bold transition-colors">
                        📦 {{ $course->modules->count() ?? 0 }} Modul
                    </a>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full {{ $course->status == 'open' ? 'bg-lime-100 text-lime-800' : 'bg-red-100 text-red-800' }}">
                        {{ strtoupper($course->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                    <a href="{{ route('admin.learning.edit', $course->id) }}" class="text-blue-600 hover:text-blue-900 dark:hover:text-blue-400">Edit</a>
                    <form action="{{ route('admin.learning.destroy', $course->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus kelas ini sekaligus bab materinya?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 dark:hover:text-red-400">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-slate-500 border-2 border-dashed border-slate-200">
                    Belum ada program kursus yang dibuat.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
