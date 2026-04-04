<section class="max-w-7xl mx-auto px-6 py-24 relative">
    <div class="glass-card rounded-[4rem] p-10 md:p-20 border-2 border-white dark:border-slate-800 bg-white/40 dark:bg-slate-950/40 shadow-[0_40px_100px_-20px_rgba(0,0,0,0.1)] dark:shadow-none">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div class="order-2 lg:order-1 relative">
                <div class="grid grid-cols-2 gap-6">
                    <div class="aspect-square rounded-3xl bg-lime-400 dark:bg-lime-500 shadow-lg p-6 flex items-center justify-center transform -rotate-3">
                        <img src="https://illustrations.popsy.co/lime/creative-work.svg" alt="Creative" class="w-full h-auto brightness-0">
                    </div>
                    <div class="aspect-square rounded-3xl bg-slate-900 dark:bg-white p-6 flex items-center justify-center transform rotate-6 translate-y-8 shadow-2xl">
                        <img src="https://illustrations.popsy.co/lime/data-analysis.svg" alt="Data" class="w-full h-auto dark:invert">
                    </div>
                </div>
            </div>

            <div class="order-1 lg:order-2 space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-lime-100 dark:bg-lime-900/50 border border-lime-200 dark:border-lime-800">
                    <span class="w-2 h-2 rounded-full bg-lime-500"></span>
                    <span class="text-[10px] font-black uppercase tracking-widest text-lime-700 dark:text-lime-300">Skilled Advisors</span>
                </div>

                <h2 class="font-heading text-4xl md:text-6xl text-slate-900 dark:text-white leading-tight">
                    Start Your <span class="italic text-transparent bg-clip-text bg-gradient-to-r from-lime-500 to-emerald-500">Digital Quest</span>
                </h2>

                <p class="text-lg text-slate-600 dark:text-lime-100/60 font-medium leading-relaxed">
                    Bergabunglah dengan platform terbaik untuk mengasah skill-mu. Akses bimbingan eksklusif dan komunitas yang suportif.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                    @foreach(['Exclusive Coach', 'Creative Minds', 'Master Certified', 'Video Tutorials'] as $feature)
                    <div class="flex items-center gap-4 group">
                        <div class="w-12 h-12 rounded-2xl bg-white dark:bg-slate-800 shadow-md flex items-center justify-center group-hover:bg-lime-400 transition-colors duration-500">
                            <svg class="w-6 h-6 text-lime-600 dark:text-lime-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="font-bold text-slate-700 dark:text-lime-100">{{ $feature }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-24 pt-12 border-t border-slate-200 dark:border-slate-800">
            <p class="text-center text-[10px] font-black text-slate-400 dark:text-slate-600 uppercase tracking-[0.5em] mb-12">Trusted Global Ecosystems</p>
            <div class="flex flex-wrap justify-center items-center gap-12 md:gap-24 opacity-40 dark:opacity-20 grayscale">
                <span class="font-heading text-2xl text-slate-900 dark:text-white">YOTA.HUB</span>
                <span class="font-heading text-2xl text-slate-900 dark:text-white">ADIWIDYA</span>
                <span class="font-heading text-2xl text-slate-900 dark:text-white">ECOSYSTEM</span>
                <span class="font-heading text-2xl text-slate-900 dark:text-white">HUB.DIGITAL</span>
            </div>
        </div>
    </div>
</section>
