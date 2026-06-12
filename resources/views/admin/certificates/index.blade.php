@extends('admin.layouts.app')

@section('title', 'Verifikasi Sertifikat & Piagam')

@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-900 p-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tight">🏆 Verifikasi Sertifikat</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Pilih kegiatan untuk melihat daftar peserta yang perlu diverifikasi sertifikatnya.</p>
            </div>
            <a href="{{ route('admin.learning.index') }}" class="px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 font-bold text-sm rounded-xl hover:bg-slate-50 dark:bg-slate-900 transition">
                ← Kelola Modul
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-lime-50 border border-lime-200 text-lime-800 rounded-xl font-bold text-sm">✅ {{ session('success') }}</div>
        @endif

        <div class="mb-6">
            <h2 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Kegiatan Seminar & Webinar</h2>
        </div>

        <div class="grid gap-6">
            @forelse($modules as $module)
            @php
                $pending = $module->users->filter(fn($u) => !$u->pivot->certificate_code)->count();
            @endphp
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm p-6 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center text-2xl">📚</div>
                    <div>
                        <h3 class="font-black text-slate-900 dark:text-white">{{ $module->title }}</h3>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="text-xs font-bold {{ $module->grading_type === 'manual' ? 'text-amber-600' : 'text-blue-600' }}">
                                {{ $module->grading_type === 'manual' ? '📝 Manual (Bukti Keikutsertaan)' : '⚡ Otomatis' }}
                            </span>
                            <span class="text-xs text-slate-400">·</span>
                            <span class="text-xs font-bold text-slate-600 dark:text-slate-400">{{ $module->users->count() }} peserta terdaftar</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    @if($pending > 0)
                    <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-black rounded-full">
                        {{ $pending }} menunggu verifikasi
                    </span>
                    @else
                    <span class="px-3 py-1 bg-lime-100 text-lime-700 text-xs font-black rounded-full">✅ Semua diverifikasi</span>
                    @endif
                    <a href="{{ route('admin.certificates.show', $module->id) }}"
                       class="px-4 py-2 bg-slate-900 text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-lime-500 hover:text-slate-900 dark:text-white transition">
                        Verifikasi Peserta →
                    </a>
                </div>
            </div>
            @empty
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-16 text-center border border-slate-100 dark:border-slate-700">
                <p class="text-4xl mb-3">📭</p>
                <p class="font-bold text-slate-600 dark:text-slate-400">Belum ada acara Seminar/Webinar. <a href="{{ route('admin.seminars.create') }}" class="text-lime-600 underline">Tambah kegiatan sekarang →</a></p>
            </div>
            @endforelse
        </div>

        <div class="mt-12 mb-6">
            <h2 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Program E-Learning (Short Course)</h2>
        </div>

        <div class="grid gap-6">
            @forelse($courses as $course)
            @php
                // Count how many task submissions need approval
                $task = \App\Models\CourseTask::where('course_id', $course->id)->first();
                $pending = 0;
                if($task) {
                    $pending = \App\Models\TaskSubmission::where('task_id', $task->id)->where('status', 'submitted')->count();
                }
            @endphp
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm p-6 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-slate-100 dark:bg-slate-800 rounded-2xl flex items-center justify-center text-2xl">💻</div>
                    <div>
                        <h3 class="font-black text-slate-900 dark:text-white">{{ $course->title }}</h3>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="text-xs font-bold {{ $course->grading_type === 'manual' ? 'text-amber-600' : 'text-blue-600' }}">
                                {{ $course->grading_type === 'manual' ? '📝 Manual (Submit Tugas Akhir)' : '⚡ Otomatis' }}
                            </span>
                            <span class="text-xs text-slate-400">·</span>
                            <span class="text-xs font-bold text-slate-600 dark:text-slate-400">Peserta terdaftar</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    @if($course->grading_type === 'manual')
                        @if($pending > 0)
                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-black rounded-full">
                            {{ $pending }} tugas menunggu verifikasi
                        </span>
                        @else
                        <span class="px-3 py-1 bg-lime-100 text-lime-700 text-xs font-black rounded-full">✅ Semua diverifikasi</span>
                        @endif
                    @else
                        <span class="px-3 py-1 bg-slate-100 text-slate-500 text-xs font-bold rounded-full">Tidak ada tugas</span>
                    @endif

                    <a href="{{ route('admin.certificates.showCourse', $course->id) }}"
                       class="px-4 py-2 bg-slate-900 text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-lime-500 hover:text-slate-900 dark:text-white transition">
                        Verifikasi Tugas →
                    </a>
                </div>
            </div>
            @empty
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-16 text-center border border-slate-100 dark:border-slate-700">
                <p class="text-4xl mb-3">📭</p>
                <p class="font-bold text-slate-600 dark:text-slate-400">Belum ada modul E-Learning.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
