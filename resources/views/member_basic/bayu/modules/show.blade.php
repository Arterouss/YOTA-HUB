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

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- Video Player (Kalau ada recording_link atau quiz_link) --}}
        @php
            $videoUrl = $module->recording_link ?? $module->quiz_link;
        @endphp

        @if($videoUrl)
        <div class="aspect-video bg-slate-900 w-full relative">
            @if(Str::contains($videoUrl, 'youtube.com') || Str::contains($videoUrl, 'youtu.be'))
                @php
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $videoUrl, $match);
                    $youtube_id = $match[1] ?? null;
                @endphp
                @if($youtube_id)
                <iframe class="w-full h-full absolute inset-0"
                        src="https://www.youtube.com/embed/{{ $youtube_id }}"
                        title="Video Player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                </iframe>
                @else
                <div class="w-full h-full flex flex-col items-center justify-center space-y-4 cursor-pointer" onclick="window.open('{{ $videoUrl }}', '_blank')">
                    <svg class="w-16 h-16 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-white font-bold tracking-widest text-sm uppercase">Buka Video Pembelajaran</span>
                </div>
                @endif
            @else
            <div class="w-full h-full flex flex-col items-center justify-center space-y-4 cursor-pointer" onclick="window.open('{{ $videoUrl }}', '_blank')">
                <svg class="w-16 h-16 text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-white font-bold tracking-widest text-sm uppercase">Buka Video Sesi Ini</span>
            </div>
            @endif
        </div>
        @endif

        <div class="p-8 lg:p-12">
            <h1 class="text-3xl font-bold text-slate-900 mb-6">{{ $module->title }}</h1>

            <div class="prose max-w-none text-slate-600 mb-10">
                {!! nl2br(e($module->description)) !!}
            </div>

            @if($module->attachment_link)
            <div class="mb-10 p-6 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-rose-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11l2 2m0 0l2-2m-2 2V7"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900">Buku Panduan Ekstra</h4>
                        <p class="text-xs text-slate-500">PDF / Dokumen Referensi</p>
                    </div>
                </div>
                <a href="{{ $module->attachment_link }}" target="_blank" class="px-5 py-2.5 bg-slate-900 text-white text-xs font-bold uppercase tracking-widest rounded-xl hover:bg-slate-800 transition">Download</a>
            </div>
            @endif

            <hr class="border-gray-100 mb-10">

            {{-- Alert Messages --}}
            @if(session('success'))
            <div class="mb-6 p-4 bg-lime-50 border border-lime-200 rounded-xl text-lime-800 font-bold text-sm">✅ {{ session('success') }}</div>
            @endif
            @if(session('info'))
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl text-blue-800 font-bold text-sm">ℹ️ {{ session('info') }}</div>
            @endif
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            {{-- SECTION AKSI: Berbeda berdasarkan grading_type --}}
            @php
                $pivot = $module->users()->where('user_id', auth()->id())->first();
                $hasSubmitted = $pivot && $pivot->pivot->submission_link;
                $hasCertificate = $pivot && $pivot->pivot->certificate_code;
                $certCode = $pivot ? $pivot->pivot->certificate_code : null;
            @endphp

            @if($hasCertificate)
            {{-- === PIAGAM TERSEDIA === --}}
            <div class="p-8 bg-gradient-to-br from-amber-50 to-lime-50 border-2 border-lime-400 rounded-2xl text-center">
                <div class="text-5xl mb-4">🏆</div>
                <h3 class="text-2xl font-black text-slate-900 mb-2">Selamat! Piagammu Sudah Siap!</h3>
                <p class="text-slate-600 mb-6">Nilai Akhir: <strong class="text-lime-600 text-xl">{{ $pivot->pivot->quiz_score }} / 100</strong></p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('member.certificate.download', $certCode) }}" target="_blank"
                       class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 text-white font-black uppercase tracking-widest rounded-2xl hover:bg-lime-500 hover:text-slate-900 transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                        📥 Unduh Piagam PDF
                    </a>
                    <a href="{{ route('certificate.verify', $certCode) }}" target="_blank"
                       class="inline-flex items-center gap-3 px-8 py-4 bg-white border-2 border-slate-200 text-slate-700 font-bold uppercase tracking-widest rounded-2xl hover:border-lime-400 transition-all">
                        🔍 Verifikasi Piagam
                    </a>
                </div>
            </div>

            @elseif($module->grading_type === 'manual')
            {{-- === MANUAL: Form Submit Tugas === --}}
            <div class="text-center">
                @if($hasSubmitted)
                    <div class="p-6 bg-amber-50 border border-amber-200 rounded-2xl">
                        <p class="text-2xl mb-2">📎</p>
                        <p class="font-black text-amber-800 text-lg">Tugas Sudah Dikumpulkan!</p>
                        <p class="text-sm text-amber-700 mt-2">Menunggu penilaian dari Admin Program. Piagam akan tersedia begitu nilai sudah dipublish.</p>
                        <p class="text-xs text-amber-600 mt-3 font-mono bg-amber-100 p-2 rounded-lg">{{ $pivot->pivot->submission_link }}</p>
                    </div>
                @else
                    <div class="p-6 bg-slate-50 rounded-2xl text-left">
                        <h3 class="font-black text-slate-900 text-lg mb-1">📝 Kumpulkan Tugas Kamu</h3>
                        <p class="text-sm text-slate-500 mb-5">Selesaikan materi di atas, lalu submit link hasil kerjamu (Google Drive, Notion, GitHub, dll).</p>
                        <form action="{{ route('member.modules.submit', $module->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Link Tugas / Hasil Kerja *</label>
                                <input type="url" name="submission_link" required
                                       class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-lime-400"
                                       placeholder="https://drive.google.com/..."
                                       value="{{ old('submission_link') }}">
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Catatan / Keterangan (Opsional)</label>
                                <textarea name="submission_note" rows="3"
                                          class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-lime-400"
                                          placeholder="Ceritakan singkat apa yang kamu kerjakan...">{{ old('submission_note') }}</textarea>
                            </div>
                            <button type="submit"
                                    class="w-full py-4 bg-slate-900 text-white font-black uppercase tracking-widest rounded-2xl hover:bg-lime-500 hover:text-slate-900 transition-all shadow-lg text-sm">
                                📤 Kumpulkan Tugas
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            @else
            {{-- === AUTO: Tombol Klaim Langsung === --}}
            <div class="text-center">
                @if($isDone)
                    <div class="inline-flex items-center gap-3 px-8 py-4 bg-lime-400 text-slate-900 font-bold uppercase tracking-widest rounded-2xl cursor-default">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Selesai (+{{ $module->quota ?? 100 }} XP Diklaim)
                    </div>
                    <p class="text-sm text-slate-500 mt-4">Admin akan segera menerbitkan piagam untuk modul ini.</p>
                @else
                    <form action="{{ route('member.modules.markDone', $module->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 text-white font-black uppercase tracking-widest rounded-2xl hover:bg-lime-500 hover:text-slate-900 transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Tandai Modul Selesai & Klaim +{{ $module->quota ?? 100 }} XP
                        </button>
                    </form>
                    <p class="text-xs text-slate-400 mt-4">*Pastikan kamu sudah selesai memahami seluruh materi sebelum mengeklik tombol ini.</p>
                @endif
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
