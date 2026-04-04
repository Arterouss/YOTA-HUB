@extends('public.layouts.app')

@section('content')


    @include('public.partials.cta')
    @include('public.partials.2')

<section id="explore" class="max-w-7xl mx-auto px-4 py-24">
        <div class="text-center mb-16">
            <h2 class="font-heading text-3xl md:text-5xl text-slate-900 dark:text-white mb-4 uppercase">Explore Categories</h2>
            <p class="text-slate-500 font-bold uppercase tracking-widest text-xs">Pilih jalur pengembangan skill kamu</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div class="glass-card p-8 rounded-[2.5rem] text-center hover:scale-105 transition cursor-pointer group border-b-8 border-lime-400">
                <div class="w-20 h-20 bg-lime-100 dark:bg-lime-900/50 rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:rotate-12 transition">
                    <img src="https://illustrations.popsy.co/lime/programming.svg" alt="Dev" class="w-12 h-12">
                </div>
                <h3 class="font-heading text-lg text-slate-900 dark:text-white uppercase">Development</h3>
            </div>

            <div class="glass-card p-8 rounded-[2.5rem] text-center hover:scale-105 transition cursor-pointer group border-b-8 border-yellow-300">
                <div class="w-20 h-20 bg-yellow-50 dark:bg-yellow-900/30 rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:rotate-12 transition">
                    <img src="https://illustrations.popsy.co/lime/graphic-design.svg" alt="Design" class="w-12 h-12">
                </div>
                <h3 class="font-heading text-lg text-slate-900 dark:text-white uppercase">Art & Design</h3>
            </div>

            </div>
    </section>

@endsection
