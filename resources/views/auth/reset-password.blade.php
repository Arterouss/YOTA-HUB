@extends('layouts.guest')

@section('content')
<div class="max-w-md mx-auto min-h-[80vh] flex items-center justify-center p-4">
    <div class="w-full glass-card rounded-[2.5rem] p-8 sm:p-10 shadow-2xl relative overflow-hidden">

        <div class="absolute -top-10 -left-10 w-32 h-32 bg-lime-400/20 rounded-full blur-2xl"></div>

        <div class="relative z-10">
            <div class="mb-8 text-center sm:text-left">
                <h1 class="font-heading text-2xl text-slate-900 dark:text-white leading-tight uppercase">New Password</h1>
                <p class="text-slate-500 dark:text-lime-200/60 font-bold text-xs mt-2">
                    Waktunya bikin password baru yang lebih kuat buat akun YOTA HUB kamu. ⚡
                </p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label class="block text-[10px] font-black text-lime-800 dark:text-lime-400 uppercase tracking-widest mb-1 ml-1">Email Kamu</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus readonly
                        class="w-full p-4 rounded-2xl border-2 border-lime-100 dark:border-lime-900 bg-slate-50 dark:bg-slate-800/50 text-slate-500 font-bold text-sm cursor-not-allowed opacity-70">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-[10px] font-black text-lime-800 dark:text-lime-400 uppercase tracking-widest mb-1 ml-1">Password Baru</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full p-4 rounded-2xl border-2 border-lime-100 dark:border-lime-900 focus:border-lime-500 focus:ring-0 transition bg-white/50 dark:bg-slate-900/50 text-slate-700 dark:text-white font-bold shadow-sm">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500" />
                </div>

                <div>
                    <label class="block text-[10px] font-black text-lime-800 dark:text-lime-400 uppercase tracking-widest mb-1 ml-1">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full p-4 rounded-2xl border-2 border-lime-100 dark:border-lime-900 focus:border-lime-500 focus:ring-0 transition bg-white/50 dark:bg-slate-900/50 text-slate-700 dark:text-white font-bold shadow-sm">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold text-red-500" />
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full btn-lemon py-4 rounded-2xl font-heading text-sm tracking-widest uppercase shadow-lg">
                        Ganti Password Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
