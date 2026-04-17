@extends('member_basic.layouts.app')

@section('title', $article->title)

@section('content')
<div class="max-w-4xl mx-auto pb-32 mt-6 px-4 relative">
    
    <a href="{{ route('member.knowledge.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 mb-6 hover:text-lime-600 transition-colors">
        🔙 KEMBALI KE MODULE
    </a>

    {{-- Kepala Artikel --}}
    <div class="text-center mb-10">
        <span class="inline-block px-3 py-1 bg-lime-400 text-slate-900 rounded-md text-[10px] font-black uppercase tracking-widest mb-4">
            {{ $article->category ? $article->category->category_name : 'Knowledge' }}
        </span>
        <h1 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white leading-tight mb-6">{{ $article->title }}</h1>
        <div class="flex flex-wrap justify-center items-center gap-4 text-xs font-bold text-slate-500">
            <span>Penulis: <span class="text-slate-700 dark:text-slate-300">{{ $article->author ? $article->author->name : '-' }}</span></span>
            <span>•</span>
            <span>⏱️ {{ $article->reading_time }} Menit Baca</span>
            <span>•</span>
            <span>👁️ {{ $article->view_count }} Kali Dibaca</span>
            <span>•</span>
            <span>📅 {{ $article->publish_date ? $article->publish_date->format('d M Y') : $article->created_at->format('d M Y') }}</span>
        </div>
    </div>

    @if($article->featured_image)
        <div class="w-full aspect-[21/9] bg-slate-200 rounded-[2rem] overflow-hidden mb-10 shadow-xl">
            <img src="{{ asset($article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
        </div>
    @endif

    {{-- Isi Artikel --}}
    <div class="bg-white dark:bg-slate-800 p-8 md:p-12 rounded-[3rem] shadow-2xl mb-12 prose prose-lg prose-slate dark:prose-invert max-w-none prose-headings:font-black prose-p:text-slate-600 dark:prose-p:text-slate-300 leading-loose">
        {!! $article->content !!}
    </div>

    {{-- Resources / Lampiran --}}
    @if($article->resources->count() > 0)
        <div class="bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-3xl p-8 mb-12">
            <h3 class="text-sm font-black uppercase text-slate-900 dark:text-white tracking-widest mb-6 flex items-center gap-2">📎 Referensi & Lampiran</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($article->resources as $res)
                    <a href="{{ $res->resource_url ?? asset($res->file_path) }}" target="_blank" class="flex gap-4 items-center bg-white dark:bg-slate-800 p-4 rounded-2xl hover:border-lime-400 border border-transparent transition-colors shadow-sm">
                        <div class="w-10 h-10 bg-slate-100 dark:bg-slate-700 rounded-xl flex items-center justify-center text-lg">📄</div>
                        <div class="flex-1">
                            <p class="text-xs font-bold text-slate-900 dark:text-white">{{ $res->resource_title }}</p>
                            <p class="text-[10px] text-slate-500 uppercase">{{ $res->resource_type }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Section Komentar Bersarang --}}
    <div class="mb-12">
        <h3 class="text-2xl font-black text-slate-900 dark:text-white uppercase mb-8">🗣️ Ruang Diskusi Terbuka ({{ $comments->count() }})</h3>
        
        <form action="{{ route('member.knowledge.postComment', $article->id) }}" method="POST" class="mb-10">
            @csrf
            <textarea name="comment_content" rows="3" class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl p-4 text-sm focus:border-lime-400 focus:ring focus:ring-lime-100 transition-all dark:text-white mb-3" placeholder="Tulis wawasan atau pertanyaan Anda mengenai artikel ini..." required></textarea>
            <div class="flex justify-end">
                <button type="submit" class="bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-6 py-2 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-lime-400 hover:text-slate-900 transition-all">Submit Feedback</button>
            </div>
        </form>

        <div class="space-y-6">
            @foreach($comments as $comment)
                <div class="bg-slate-50 dark:bg-slate-800/50 rounded-3xl p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-lime-400 flex items-center justify-center font-black text-slate-900 text-xs">
                                {{ substr($comment->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-900 dark:text-white">{{ $comment->user->name }}</p>
                                <p class="text-[10px] text-slate-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <button onclick="toggleLike('{{ $comment->id }}')" class="flex items-center gap-1 text-[10px] font-bold text-slate-400 hover:text-pink-500" id="like-btn-{{ $comment->id }}">
                            <span id="like-icon-{{ $comment->id }}">❤️</span> <span id="like-count-{{ $comment->id }}">{{ $comment->likes->count() }}</span>
                        </button>
                    </div>
                    <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed">{{ $comment->comment_content }}</p>
                    
                    {{-- Form Balasan --}}
                    <div class="mt-4">
                        <button onclick="toggleReplyForm('{{ $comment->id }}')" class="text-[10px] font-bold text-blue-500 uppercase">Balas Diskusi</button>
                        <form id="reply-form-{{ $comment->id }}" action="{{ route('member.knowledge.postComment', $article->id) }}" method="POST" class="hidden mt-3 ml-4 border-l-2 border-slate-200 pl-4">
                            @csrf
                            <input type="hidden" name="parent_comment_id" value="{{ $comment->id }}">
                            <textarea name="comment_content" rows="2" class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl p-3 text-xs focus:border-lime-400 mb-2" placeholder="Tulis balasan..." required></textarea>
                            <button type="submit" class="bg-lime-400 text-slate-900 px-4 py-1.5 rounded-lg font-black text-[10px] uppercase">Kirim Balasan</button>
                        </form>
                    </div>

                    {{-- Replies --}}
                    @if($comment->replies->count() > 0)
                        <div class="mt-6 ml-6 pl-4 border-l-2 border-slate-200 dark:border-slate-700 space-y-4">
                            @foreach($comment->replies as $reply)
                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="w-6 h-6 rounded-full bg-slate-300 flex items-center justify-center font-black text-slate-600 text-[10px]">
                                            {{ substr($reply->user->name, 0, 1) }}
                                        </div>
                                        <p class="text-[10px] font-bold text-slate-900 dark:text-white">{{ $reply->user->name }} <span class="text-slate-400 font-normal ml-1">{{ $reply->created_at->diffForHumans() }}</span></p>
                                    </div>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">{{ $reply->comment_content }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- GAMIFICATION FLOATING WIDGET --}}
@if(!$hasRead)
<div id="gamification-widget" class="fixed bottom-6 left-1/2 -translate-x-1/2 bg-slate-900 text-white rounded-full px-6 py-3 shadow-2xl flex items-center gap-4 z-50 transform transition-transform duration-500 translate-y-24">
    <div class="animate-spin h-4 w-4 border-2 border-lime-400 border-t-transparent rounded-full"></div>
    <span class="text-xs font-bold" id="read-status-msg">Menganalisa pembacaan... <span id="reward-timer" class="text-lime-400 ml-1">30s</span></span>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    // Gamification Timer Logic Script
    document.addEventListener("DOMContentLoaded", function() {
        const widget = document.getElementById('gamification-widget');
        const timerText = document.getElementById('reward-timer');
        const statusMsg = document.getElementById('read-status-msg');
        let timeLeft = 30; // 30 Detik minimal durasi

        // Tampilkan widget pop-up muncul dari bawah
        setTimeout(() => {
            widget.classList.remove('translate-y-24');
        }, 1000);

        const countdown = setInterval(() => {
            timeLeft--;
            if (timeLeft > 0) {
                timerText.innerText = timeLeft + 's';
            } else {
                clearInterval(countdown);
                timerText.innerText = '';
                statusMsg.innerText = 'Mengirim poin...';
                
                // Klaim Endpoint AJAX
                fetch("{{ route('member.knowledge.claimPoint', $article->id) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ duration: 30 })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        statusMsg.innerHTML = `🎉 <span class="text-lime-400">+5 Poin Kuis</span> berhasil ditambahkan!`;
                        setTimeout(() => {
                            widget.classList.add('translate-y-24'); // Hilang otomatis
                        }, 4000);
                    }
                });
            }
        }, 1000);
    });

    // Toggle forms
    function toggleReplyForm(id) {
        const f = document.getElementById('reply-form-'+id);
        f.classList.toggle('hidden');
    }

    // Toggle Likes AJAX
    function toggleLike(commentId) {
        fetch(`/learning/knowledge/comment/${commentId}/toggle-like`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            const countSpan = document.getElementById('like-count-'+commentId);
            let c = parseInt(countSpan.innerText);
            if(data.status === 'liked') { countSpan.innerText = c + 1; }
            else { countSpan.innerText = Math.max(0, c - 1); }
        });
    }
</script>
@endif
@endsection
