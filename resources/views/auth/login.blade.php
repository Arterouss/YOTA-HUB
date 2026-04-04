@extends('layouts.guest')

@section('content')
<div class="max-w-5xl mx-auto min-h-[80vh] flex items-center justify-center p-4">
    <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-0 overflow-hidden glass-card rounded-[2.5rem] shadow-2xl">

        <div class="hidden lg:flex flex-col justify-center p-12 bg-lime-400 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-lime-300 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-lime-500 rounded-full -ml-12 -mb-12"></div>

            <div class="relative z-10">
                <h2 class="font-heading text-4xl text-lime-950 mb-4 leading-tight">
                    WELCOME BACK, <br>CHAMP!
                </h2>
                <p class="text-lime-900 font-medium opacity-80">
                    Lanjutkan progres belajarmu, kumpulkan poin, dan raih reward eksklusif hari ini.
                </p>

                <div class="mt-8 transform hover:scale-105 transition duration-500">
                    <img src="https://illustrations.popsy.co/lime/success.svg" alt="Illustration" class="w-64 h-auto mx-auto">
                </div>
            </div>
        </div>

        <div class="p-8 sm:p-12 bg-white/80 flex flex-col justify-center">
            <div class="mb-8 text-center lg:text-left">
                <h1 class="font-heading text-3xl text-slate-900">Sign In</h1>
                <p class="text-slate-500 font-semibold text-sm">Masuk ke akun Kuest kamu</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-black text-lime-800 uppercase tracking-widest mb-1 ml-1">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        placeholder="yourname@gmail.com"
                        class="w-full p-4 rounded-2xl border-2 border-lime-100 focus:border-lime-500 focus:ring-0 transition bg-white text-slate-700 font-bold shadow-sm">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1 ml-1">
                        <label class="block text-xs font-black text-lime-800 uppercase tracking-widest">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-bold text-lime-600 hover:text-lime-700">Lupa?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required
                        placeholder="••••••••"
                        class="w-full p-4 rounded-2xl border-2 border-lime-100 focus:border-lime-500 focus:ring-0 transition bg-white text-slate-700 font-bold shadow-sm">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center ml-1">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="w-5 h-5 rounded border-lime-300 text-lime-500 focus:ring-lime-400 shadow-sm transition">
                    <span class="ms-3 text-sm font-bold text-slate-600">{{ __('Remember me') }}</span>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full btn-lemon py-4 rounded-2xl font-heading text-lg tracking-wide uppercase">
                        Let's Go!
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm font-bold text-slate-400 mb-4">OR CONTINUE WITH</p>
<div class="mt-6 border-t border-gray-200 pt-6">
    <a href="{{ route('google.login') }}" class="flex w-full justify-center items-center gap-3 bg-white border border-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-50 transition duration-150 shadow-sm">
        <svg class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
            <path d="M5.84 14.1c-.22-.66-.35-1.36-.35-2.1s.13-1.44.35-2.1V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l3.66-2.84z" fill="#FBBC05"/>
            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
        </svg>
        <span>Lanjutkan dengan Google</span>
    </a>
</div>

                <p class="mt-8 text-sm font-bold text-slate-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-lime-600 hover:underline">Daftar sekarang!</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
