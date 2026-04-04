@extends('layouts.guest')

@section('content')
<div class="max-w-md mx-auto min-h-[75vh] flex items-center justify-center p-4">
    <div class="w-full glass-card rounded-[2.5rem] p-8 sm:p-12 shadow-2xl relative overflow-hidden border-2 border-lime-400/30">

        <div class="flex justify-center mb-8">
            <div class="relative">
                <div class="w-24 h-24 bg-lime-100 dark:bg-lime-900/40 rounded-full flex items-center justify-center animate-bounce">
                    <svg class="w-12 h-12 text-lime-600 dark:text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="absolute -top-2 -right-2 w-6 h-6 bg-yellow-400 rounded-full border-4 border-white dark:border-slate-900"></div>
            </div>
        </div>

        <div class="text-center mb-8">
            <h1 class="font-heading text-2xl text-slate-900 dark:text-white uppercase tracking-tight">Cek Inbox Kamu!</h1>
            <p class="text-slate-500 dark:text-lime-200/60 font-bold text-sm mt-4 leading-relaxed">
                Terima kasih sudah bergabung! Tolong klik link verifikasi yang baru saja kami kirim ke emailmu ya. Belum masuk? Cek folder spam atau klik tombol di bawah.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 p-4 rounded-2xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 text-xs font-black uppercase tracking-widest text-center animate-pulse">
                Link baru sudah meluncur!
            </div>
        @endif

        <div class="space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full btn-lemon py-4 rounded-2xl font-heading text-xs tracking-widest uppercase">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit" class="text-[10px] font-black text-slate-400 dark:text-lime-700 hover:text-lime-500 uppercase tracking-widest transition underline decoration-2 underline-offset-4">
                    Ganti Akun / Log Out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
