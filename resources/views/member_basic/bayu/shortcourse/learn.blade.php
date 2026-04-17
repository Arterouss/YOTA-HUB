@extends('member_basic.layouts.app')

@section('title', 'Belajar: ' . $activeModule->module_title)

@section('content')
<div class="max-w-7xl mx-auto pb-20 mt-6 px-4">
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Sidebar navigasi Modul --}}
        <div class="lg:w-1/3">
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-xl sticky top-6 border border-slate-100 dark:border-slate-700">
                <a href="{{ route('member.shortcourse.show', $course->id) }}" class="text-xs font-bold text-slate-400 hover:text-lime-500 mb-4 block inline-flex shadow items-center gap-2">
                    🔙 Kembali ke Info
                </a>
                
                <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase mb-2 line-clamp-2">{{ $course->title }}</h3>
                
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs font-bold text-slate-500">Progress Pembelajaran</span>
                        <span class="text-xs font-black text-lime-600">{{ $enrollment->progress_percentage }}%</span>
                    </div>
                    <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2">
                        <div class="bg-lime-400 h-2 rounded-full" style="width: {{ $enrollment->progress_percentage }}%"></div>
                    </div>
                </div>

                <div class="space-y-3">
                    @foreach($course->modules as $index => $mod)
                        @php
                            $isCompleted = isset($progressions[$mod->id]) && $progressions[$mod->id]->status === 'completed';
                            $isActive = $activeModule->id === $mod->id;
                        @endphp
                        <a href="{{ route('member.shortcourse.learn', ['course_id' => $course->id, 'module_id' => $mod->id]) }}" 
                           class="flex items-center gap-3 p-3 rounded-xl border transition-all {{ $isActive ? 'border-lime-400 bg-lime-50 dark:bg-lime-900/20' : 'border-slate-100 dark:border-slate-700 hover:border-slate-300' }}">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-black text-xs {{ $isCompleted ? 'bg-emerald-400 text-emerald-900' : 'bg-slate-200 text-slate-500' }}">
                                {{ $isCompleted ? '✓' : $index + 1 }}
                            </div>
                            <div class="flex-1">
                                <p class="text-xs font-bold text-slate-900 {{ $isActive ? 'text-lime-600' : 'dark:text-white' }}">{{ $mod->module_title }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Sertifikasi Kelulusan --}}
                @if($course->certificate_available)
                <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-700 text-center">
                    @if($enrollment->progress_percentage == 100)
                        <form action="{{ route('member.shortcourse.generateCertificate', $course->id) }}" method="POST">
                            @csrf
                            <button class="w-full bg-emerald-500 text-white font-black text-xs uppercase tracking-widest py-4 rounded-xl shadow-lg hover:bg-emerald-600 hover:-translate-y-1 transition-all">
                                🏆 KLAIM SERTIFIKAT LULUS
                            </button>
                        </form>
                    @else
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest p-4 bg-slate-50 dark:bg-slate-900 rounded-xl">
                            Selesaikan 100% untuk Sertifikat
                        </div>
                    @endif
                </div>
                @endif
            </div>
        </div>

        {{-- Main Konten Pembelajaran --}}
        <div class="lg:w-2/3">
            @if(session('success'))
                <div class="bg-lime-100 text-lime-700 px-4 py-3 rounded-2xl mb-6 font-bold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 md:p-12 shadow-xl">
                <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-blue-100 text-blue-600 mb-4 inline-block">Modul Pembelajaran</span>
                
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white uppercase mb-6">{{ $activeModule->module_title }}</h1>

                {{-- Konten Video --}}
                @if($activeModule->content_type === 'video' && $activeModule->video_url)
                <div class="aspect-video bg-slate-900 rounded-2xl overflow-hidden mb-8 shadow-inner">
                    {{-- Asumsi video url adalah youtube embed link untuk disederhanakan --}}
                    <iframe src="{{ str_replace('watch?v=', 'embed/', $activeModule->video_url) }}" class="w-full h-full border-0" allowfullscreen></iframe>
                </div>
                @endif

                {{-- Konten Artikel / Teks --}}
                <div class="prose prose-slate dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-loose">
                    {!! nl2br(e($activeModule->module_description)) !!}
                    
                    @if($activeModule->article_content)
                        <div class="mt-8">{!! $activeModule->article_content !!}</div>
                    @endif

                    @if($activeModule->text_content)
                        <div class="mt-8 p-6 bg-slate-50 dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-700">
                            {!! nl2br(e($activeModule->text_content)) !!}
                        </div>
                    @endif
                </div>

                {{-- Trigger Selesai Modul --}}
                <div class="mt-14 pt-8 border-t border-slate-100 dark:border-slate-700 border-dashed flex items-center justify-between">
                    <p class="text-xs font-bold text-slate-500">Pastikan Anda telah memahami seluruh materi ini.</p>
                    <form action="{{ route('member.shortcourse.completeModule', ['course_id' => $course->id, 'module_id' => $activeModule->id]) }}" method="POST">
                        @csrf
                        @php
                            $isCompletedNow = isset($progressions[$activeModule->id]) && $progressions[$activeModule->id]->status === 'completed';
                        @endphp
                        <button type="submit" class="bg-lime-400 text-slate-900 px-8 py-4 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-lime-500 transition-colors {{ $isCompletedNow ? 'opacity-50' : '' }}">
                            {{ $isCompletedNow ? '✓ MATERI SELESAI' : 'TANDAI SELESAI & LANJUT' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
