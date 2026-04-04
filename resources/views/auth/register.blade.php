@extends('layouts.guest')

@section('content')
<div class="max-w-6xl mx-auto min-h-screen flex items-center justify-center p-2 sm:p-4">
    <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-0 overflow-hidden glass-card rounded-[2.5rem] shadow-2xl bg-white/40">

        <div class="hidden lg:flex lg:col-span-5 flex-col justify-between p-12 bg-lime-400 text-lime-950 relative overflow-hidden">
            <div class="relative z-10">
                <div class="bg-white/30 backdrop-blur-md w-fit px-4 py-1 rounded-full text-xs font-black tracking-widest mb-6 border border-white/20">
                    DIGITAL ECOSYSTEM
                </div>
                <h1 class="font-heading text-5xl mb-2">YOTA HUB</h1>
                <p class="font-bold text-lime-900/80 mb-8">Integrated Youth Ecosystem Platform</p>

                <ul class="space-y-4">
                    <li class="flex items-center gap-3 font-bold">
                        <span class="w-6 h-6 bg-lime-950 text-lime-300 rounded-full flex items-center justify-center text-xs">✓</span>
                        E-Learning & Online Classes
                    </li>
                    <li class="flex items-center gap-3 font-bold">
                        <span class="w-6 h-6 bg-lime-950 text-lime-300 rounded-full flex items-center justify-center text-xs">✓</span>
                        Seminars & Digital Events
                    </li>
                    <li class="flex items-center gap-3 font-bold">
                        <span class="w-6 h-6 bg-lime-950 text-lime-300 rounded-full flex items-center justify-center text-xs">✓</span>
                        Collaborative Projects
                    </li>
                    <li class="flex items-center gap-3 font-bold">
                        <span class="w-6 h-6 bg-lime-950 text-lime-300 rounded-full flex items-center justify-center text-xs">✓</span>
                        Active Gamification System
                    </li>
                </ul>
            </div>

            <div class="relative z-10 mt-10 p-6 rounded-3xl bg-lime-300/50 border border-lime-500/30">
                <p class="text-sm italic font-medium">"Connecting youth with knowledge, communities, and real action opportunities."</p>
            </div>

            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-lime-300 rounded-full opacity-50"></div>
        </div>

        <div class="lg:col-span-7 p-6 sm:p-12 bg-white/90">
            <div class="mb-8">
                <h2 class="font-heading text-3xl text-slate-900">Join the Movement</h2>
                <p class="text-slate-500 font-bold text-sm">Create your YOTA HUB account</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-lime-800 uppercase tracking-tighter mb-1 ml-1">Full Name</label>
                        <input id="name" type="text" name="name" :value="old('name')" required autofocus
                            class="w-full p-3 rounded-2xl border-2 border-lime-100 focus:border-lime-500 focus:ring-0 transition bg-white font-bold shadow-sm text-sm">
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-lime-800 uppercase tracking-tighter mb-1 ml-1">Email Address</label>
                        <input id="email" type="email" name="email" :value="old('email')" required
                            class="w-full p-3 rounded-2xl border-2 border-lime-100 focus:border-lime-500 focus:ring-0 transition bg-white font-bold shadow-sm text-sm">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-lime-800 uppercase tracking-tighter mb-1 ml-1">Password</label>
                        <input id="password" type="password" name="password" required
                            class="w-full p-3 rounded-2xl border-2 border-lime-100 focus:border-lime-500 focus:ring-0 transition bg-white font-bold shadow-sm text-sm">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-lime-800 uppercase tracking-tighter mb-1 ml-1">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full p-3 rounded-2xl border-2 border-lime-100 focus:border-lime-500 focus:ring-0 transition bg-white font-bold shadow-sm text-sm">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>
                </div>

                <div class="bg-lime-50 p-4 rounded-2xl border border-lime-100">
                    <label for="terms" class="flex items-start gap-3 cursor-pointer">
                        <input id="terms" type="checkbox" name="terms" required
                            class="mt-1 w-5 h-5 rounded border-lime-300 text-lime-500 focus:ring-lime-400 transition">
                        <span class="text-xs font-bold text-slate-600 leading-relaxed">
                            Saya telah membaca dan menyetujui
                            <a target="_blank" href="{{ route('terms') }}" class="text-lime-600 underline">Syarat dan Ketentuan</a>
                            serta <a target="_blank" href="{{ route('privacy') }}" class="text-lime-600 underline">Kebijakan Privasi</a> YOTA HUB.
                        </span>
                    </label>
                    <x-input-error :messages="$errors->get('terms')" class="mt-2" />
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full btn-lemon py-4 rounded-2xl font-heading text-lg tracking-wide uppercase group">
                        Enter YOTA HUB <span class="inline-block transition-transform group-hover:translate-x-2">→</span>
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm font-bold text-slate-500">
                    Sudah jadi bagian dari ekosistem?
                    <a href="{{ route('login') }}" class="text-lime-600 hover:underline">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
