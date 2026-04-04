<section class="max-w-7xl mx-auto px-6 pt-16 pb-24 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center relative">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-lime-400/20 dark:bg-lime-500/10 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="lg:col-span-7 space-y-10 text-center lg:text-left relative z-10">
        <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full bg-white/50 dark:bg-lime-950/30 border border-lime-200 dark:border-lime-800/50 backdrop-blur-sm shadow-sm">
            <span class="w-2 h-2 rounded-full bg-lime-500 animate-pulse"></span>
            <span class="text-[10px] font-black tracking-[0.2em] text-lime-800 dark:text-lime-400 uppercase">Youth Empowerment Platform</span>
        </div>

        <h1 class="font-heading text-6xl md:text-8xl text-slate-900 dark:text-white leading-[0.95] tracking-tighter">
            BUILD THE <br>
            <span class="text-lime-500 dark:text-lime-400 drop-shadow-[0_0_15px_rgba(163,230,53,0.3)]">FUTURE</span> <br>
            <span class="relative">
                WITH TECH.
                <svg class="absolute -bottom-2 left-0 w-full h-3 text-lime-400/50 dark:text-lime-400/20 -z-10" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 25 0, 50 5 T 100 5" stroke="currentColor" stroke-width="8" fill="transparent"/></svg>
            </span>
        </h1>

        <p class="text-xl text-slate-600 dark:text-lime-100/60 font-medium max-w-xl mx-auto lg:mx-0 leading-relaxed italic border-l-4 border-lime-400 pl-6">
            Ekosistem kolaborasi terintegrasi untuk menghubungkan pemuda dengan pengetahuan, komunitas, dan aksi nyata.
        </p>

        <div class="flex flex-col sm:flex-row gap-6 justify-center lg:justify-start pt-4">
            <a href="{{ route('login') }}" class="btn-lemon px-12 py-5 rounded-[2rem] font-heading text-xl tracking-wide shadow-[0_20px_40px_-15px_rgba(163,230,53,0.5)] group">
                Mulai Quest <span class="inline-block transition-transform group-hover:translate-x-2">⚡</span>
            </a>
            <a href="#explore" class="group bg-white/80 dark:bg-slate-800/50 backdrop-blur-md border-2 border-slate-200 dark:border-slate-700 px-12 py-5 rounded-[2rem] font-bold text-xl text-slate-900 dark:text-white hover:border-lime-400 dark:hover:border-lime-500 transition-all shadow-xl hover:shadow-lime-400/10">
                Pelajari
            </a>
        </div>
    </div>

    <div class="lg:col-span-5 relative group">
        <div class="absolute -inset-1 bg-gradient-to-tr from-lime-400 to-yellow-300 rounded-[4rem] blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
        <div class="relative glass-card rounded-[3.5rem] overflow-hidden aspect-[4/5] lg:aspect-square flex items-center justify-center border-[6px] border-white dark:border-slate-800 shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-lime-100/20 dark:to-lime-900/10"></div>
            <img src="https://illustrations.popsy.co/lime/remote-work.svg" alt="Yota Hub" class="w-4/5 h-auto z-10 drop-shadow-2xl transform group-hover:scale-110 group-hover:-rotate-3 transition duration-700">

            <div class="absolute bottom-8 right-8 bg-white/90 dark:bg-slate-900/90 p-4 rounded-2xl shadow-xl border border-lime-100 dark:border-lime-800 backdrop-blur-md animate-bounce">
                <p class="text-[10px] font-black text-lime-600 uppercase">Active Now</p>
                <p class="text-lg font-heading text-slate-900 dark:text-white">500+ Players</p>
            </div>
        </div>
    </div>
</section>
