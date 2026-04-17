@extends('admin.layouts.app')

@section('title', 'Kelola Sub-Modul - ' . $course->title)

@section('content')
<div class="sm:flex sm:items-center sm:justify-between mb-8">
    <div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.learning.index') }}" class="p-2 bg-slate-100 rounded-lg hover:bg-slate-200 text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="text-2xl font-bold text-slate-800">Manajemen Silabus & Materi Video</h2>
        </div>
        <p class="mt-1 text-sm text-slate-500 ml-11">Kursus: <strong>{{ $course->title }}</strong></p>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="{{ route('admin.learning.modules.create', $course->id) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 transition-colors">
            + Tambah Bab Baru
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase">Urutan</th>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase">Judul Bab</th>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase">Tipe Akses</th>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase">Video URL</th>
                <th class="px-6 py-4 text-right text-xs font-black text-slate-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($modules as $module)
            <tr>
                <td class="px-6 py-4 text-sm font-bold text-slate-900">
                    Bab {{ $module->module_order }}
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-bold text-slate-900">{{ $module->module_title }}</div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-slate-100 text-slate-800">
                        {{ strtoupper($module->content_type) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-slate-500 truncate max-w-[200px]">
                    @if($module->video_url)
                        <a href="{{ $module->video_url }}" target="_blank" class="text-blue-500 hover:underline">Tonton Link</a>
                    @else
                        -
                    @endif
                </td>
                <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                    <a href="{{ route('admin.learning.modules.edit', [$course->id, $module->id]) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                    <form action="{{ route('admin.learning.modules.destroy', [$course->id, $module->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus bab modul ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                    Kopong. Belum ada materi bab satupun.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
