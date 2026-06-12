@extends('admin.layouts.app')

@section('title', 'Verifikasi Tugas E-Learning - ' . $course->title)

@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-900 p-8">
    <div class="max-w-5xl mx-auto">

        <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 dark:text-slate-400 mb-6 hover:text-lime-600 transition group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Panel Verifikasi
        </a>

        <div class="mb-6">
            <h1 class="text-2xl font-black text-slate-900 dark:text-white">Peserta E-Learning: {{ $course->title }}</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
                Tipe: <strong class="{{ $course->grading_type === 'manual' ? 'text-amber-600' : 'text-blue-600' }}">{{ $course->grading_type === 'manual' ? '📝 Manual (Submit Tugas Akhir)' : '⚡ Otomatis' }}</strong>
            </p>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-lime-50 border border-lime-200 text-lime-800 rounded-xl font-bold text-sm">✅ {{ session('success') }}</div>
        @endif

        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-900 text-white">
                    <tr>
                        <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-widest">Mahasiswa</th>
                        <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-widest">Tugas Akhir</th>
                        <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-widest">Status Belajar</th>
                        <th class="text-right px-6 py-4 text-xs font-bold uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($enrollments as $enrollment)
                    @php
                        $submission = $taskSubmissions[$enrollment->user->id] ?? null;
                        $hasCert = $enrollment->status === 'completed';
                    @endphp
                    <tr class="hover:bg-slate-50 dark:bg-slate-900 transition">
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-900 dark:text-white">{{ $enrollment->user->name }}</p>
                            <p class="text-xs text-slate-400">{{ $enrollment->user->email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($submission)
                                <a href="{{ $submission->submission_link }}" target="_blank"
                                   class="text-xs font-bold text-blue-600 underline hover:text-blue-800 break-all">
                                    🔗 Cek Tugas
                                </a>
                            @else
                                <span class="text-xs text-slate-400 italic">Belum mengumpulkan tugas</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($hasCert)
                                <span class="px-3 py-1 bg-lime-100 text-lime-700 text-xs font-black rounded-full">✅ Lulus & Piagam Terbit</span>
                            @elseif($submission && $submission->status === 'submitted')
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-black rounded-full">Tugas Menunggu Verifikasi</span>
                            @elseif($enrollment->payment_status === 'paid')
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-black rounded-full">Sedang Belajar</span>
                            @else
                                <span class="px-3 py-1 bg-slate-100 text-slate-500 text-xs font-black rounded-full">Menunggu Pembayaran</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($submission && $submission->status === 'submitted')
                            <form action="{{ route('admin.certificates.approveTask', [$course->id, $enrollment->user->id]) }}" method="POST" class="inline-flex items-center gap-2">
                                @csrf
                                <button type="submit"
                                        class="px-4 py-2 bg-lime-500 text-slate-900 dark:text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-lime-400 transition whitespace-nowrap">
                                    🏆 Verifikasi & Terbitkan Piagam
                                </button>
                            </form>
                            @elseif($hasCert)
                            <span class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-400 text-xs font-bold rounded-xl cursor-default">
                                Lulus
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-slate-400">
                            <p class="text-4xl mb-3">🎓</p>
                            <p class="font-bold">Belum ada peserta yang terdaftar di modul ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
