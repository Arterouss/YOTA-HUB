@extends('admin.layouts.app')

@section('title', 'Nilai Peserta - ' . $module->title)

@section('content')
<div class="min-h-screen bg-slate-50 p-8">
    <div class="max-w-5xl mx-auto">

        <a href="{{ route('admin.certificates.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 mb-6 hover:text-lime-600 transition group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Panel Penilaian
        </a>

        <div class="mb-6">
            <h1 class="text-2xl font-black text-slate-900">Peserta Modul: {{ $module->title }}</h1>
            <p class="text-slate-500 text-sm mt-1">
                Tipe: <strong class="{{ $module->grading_type === 'manual' ? 'text-amber-600' : 'text-blue-600' }}">{{ $module->grading_type === 'manual' ? '📝 Manual (Submit Tugas)' : '⚡ Otomatis' }}</strong>
            </p>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-lime-50 border border-lime-200 text-lime-800 rounded-xl font-bold text-sm">✅ {{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-900 text-white">
                    <tr>
                        <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-widest">Mahasiswa</th>
                        <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-widest">Tugas Dikumpulkan</th>
                        <th class="text-left px-6 py-4 text-xs font-bold uppercase tracking-widest">Status</th>
                        <th class="text-right px-6 py-4 text-xs font-bold uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($students as $student)
                    @php
                        $hasCert = !empty($student->pivot->certificate_code);
                    @endphp
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-900">{{ $student->name }}</p>
                            <p class="text-xs text-slate-400">{{ $student->email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($student->pivot->submission_link)
                                <a href="{{ $student->pivot->submission_link }}" target="_blank"
                                   class="text-xs font-bold text-blue-600 underline hover:text-blue-800 break-all">
                                    🔗 {{ Str::limit($student->pivot->submission_link, 40) }}
                                </a>
                                @if($student->pivot->submission_note)
                                <p class="text-xs text-slate-500 mt-1 italic">{{ $student->pivot->submission_note }}</p>
                                @endif
                            @else
                                <span class="text-xs text-slate-400 italic">Belum mengumpulkan tugas</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($hasCert)
                                <div>
                                    <span class="px-3 py-1 bg-lime-100 text-lime-700 text-xs font-black rounded-full">✅ Piagam Diterbitkan</span>
                                    <p class="text-xs text-slate-400 mt-1">Nilai: <strong>{{ $student->pivot->quiz_score }}</strong></p>
                                </div>
                            @elseif($student->pivot->is_attended)
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-black rounded-full">Selesai (Belum Dinilai)</span>
                            @else
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-black rounded-full">Menunggu Penilaian</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if(!$hasCert)
                            <form action="{{ route('admin.certificates.publish', [$module->id, $student->id]) }}" method="POST" class="inline-flex items-center gap-2">
                                @csrf
                                <input type="number" name="grade" min="0" max="100" required
                                       value="{{ $student->pivot->quiz_score ?? 80 }}"
                                       class="w-20 px-3 py-1.5 border border-slate-200 rounded-lg text-sm text-center font-bold focus:outline-none focus:ring-2 focus:ring-lime-400"
                                       placeholder="Nilai">
                                <button type="submit"
                                        class="px-4 py-2 bg-lime-500 text-slate-900 text-xs font-black uppercase tracking-widest rounded-xl hover:bg-lime-400 transition whitespace-nowrap">
                                    🏆 Publish & Terbitkan Piagam
                                </button>
                            </form>
                            @else
                            <a href="{{ route('member.certificate.download', $student->pivot->certificate_code) }}" target="_blank"
                               class="px-4 py-2 bg-slate-100 text-slate-700 text-xs font-bold rounded-xl hover:bg-slate-200 transition">
                                👁️ Lihat Piagam
                            </a>
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
