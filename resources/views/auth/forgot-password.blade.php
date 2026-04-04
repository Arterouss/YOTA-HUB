@extends('layouts.guest')

@section('content')
<div class="max-w-md mx-auto min-h-[70vh] flex items-center justify-center p-4">
    <div class="w-full glass-card rounded-[2.5rem] p-8 sm:p-10 shadow-2xl relative overflow-hidden">

        <div class="absolute -top-6 -right-6 w-24 h-24 bg-lime-400/20 rounded-full flex items-center justify-center transform rotate-12">
            <svg class="w-12 h-12 text-lime-600 dark:text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
            </svg>
        </div>

        <div class="relative z-10">
            <div class="mb-8">
                <h1 class="font-heading text-2xl text-slate-900 dark:text-white uppercase tracking-tight">Reset Akses</h1>
                <p class="text-slate-500 dark:text-lime-200/60 font-bold text-sm mt-2 leading-relaxed">
                    Lupa password? Tenang, kawan. Masukkan email kamu dan kami akan kirimkan link untuk buat password baru.
                </p>
            </div>

            <x-auth-session-status class="mb-6 p-4 rounded-2xl bg-lime-100 dark:bg-lime-900/30 text-lime-800 dark:text-lime-300 border border-lime-200 dark:border-lime-800 text-xs font-bold" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-[10px] font-black text-lime-800 dark:text-lime-400 uppercase tracking-widest mb-2 ml-1">Email Terdaftar</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        placeholder="namamu@email.com"
                        class="w-full p-4 rounded-2xl border-2 border-lime-100 dark:border-lime-900 focus:border-lime-500 focus:ring-0 transition bg-white/50 dark:bg-slate-900/50 text-slate-700 dark:text-white font-bold shadow-sm">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full btn-lemon py-4 rounded-2xl font-heading text-sm tracking-widest uppercase">
                        Kirim Link Reset 
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('login') }}" class="text-xs font-black text-lime-700 dark:text-lime-400 hover:underline uppercase tracking-tighter">
                    ← Kembali ke Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
