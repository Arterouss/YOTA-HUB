@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto min-h-[70vh] flex items-center justify-center p-4">
    <div class="w-full glass-card rounded-[2.5rem] p-8 sm:p-12 shadow-2xl relative overflow-hidden border-2 border-lime-400/50">

        <div class="mb-6 flex justify-center">
            <div class="w-20 h-20 bg-lime-100 dark:bg-lime-900/50 rounded-3xl flex items-center justify-center shadow-inner transform -rotate-6">
                <svg class="w-10 h-10 text-lime-600 dark:text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
        </div>

        <div class="text-center mb-8">
            <h1 class="font-heading text-2xl text-slate-900 dark:text-white uppercase tracking-tight">Verifikasi Akses</h1>
            <p class="text-slate-500 dark:text-lime-200/60 font-bold text-xs mt-3 leading-relaxed">
                Ini adalah area aman. Tolong konfirmasi password kamu sebelum melanjutkan perjalanan di YOTA HUB.
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-[10px] font-black text-lime-800 dark:text-lime-400 uppercase tracking-widest mb-2 ml-1">Password Kamu</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full p-4 rounded-2xl border-2 border-lime-100 dark:border-lime-900 focus:border-lime-500 focus:ring-0 transition bg-white/50 dark:bg-slate-900/50 text-slate-700 dark:text-white font-bold shadow-sm">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500" />
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full btn-lemon py-4 rounded-2xl font-heading text-sm tracking-widest uppercase flex items-center justify-center gap-2 group">
                    Konfirmasi
                    <span class="group-hover:translate-x-1 transition-transform">⚡</span>
                </button>
            </div>
        </form>

        <div class="mt-8 text-center">
            <button onclick="window.history.back()" class="text-[10px] font-black text-slate-400 dark:text-lime-700 hover:text-lime-500 uppercase tracking-widest transition">
                BATALKAN AKSES
            </button>
        </div>
    </div>
</div>
@endsection
