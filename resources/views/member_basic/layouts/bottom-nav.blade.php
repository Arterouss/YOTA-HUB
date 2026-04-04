<nav class="fixed bottom-0 left-0 z-[100] w-full bg-white/80 dark:bg-slate-900/90 backdrop-blur-2xl border-t border-lime-200/50 dark:border-lime-900/50 px-6 py-3 shadow-[0_-10px_25px_-5px_rgba(0,0,0,0.1)]">
    <div class="flex justify-between items-center max-w-md mx-auto relative">

        <a href="#"
           class="flex flex-col items-center gap-1 group transition-all duration-300">
            <div class="p-2 rounded-2xl transition-all {{ request()->routeIs('participant.dashboard') ? 'bg-lime-400 text-slate-900 shadow-lg shadow-lime-500/30' : 'text-slate-400 dark:text-slate-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            <span class="text-[9px] font-black uppercase tracking-tighter {{ request()->routeIs('participant.dashboard') ? 'text-lime-600 dark:text-lime-400' : 'text-slate-400' }}">Home</span>
        </a>

        <a href="#" class="flex flex-col items-center gap-1 group transition-all duration-300">
            <div class="p-2 rounded-2xl transition-all {{ request()->is('participant/courses*') ? 'bg-lime-400 text-slate-900 shadow-lg' : 'text-slate-400 dark:text-slate-500' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <span class="text-[9px] font-black uppercase tracking-tighter {{ request()->is('participant/courses*') ? 'text-lime-600' : 'text-slate-400' }}">Quest</span>
        </a>

        <div class="relative -mt-12 flex flex-col items-center">
            <a href="#" class="w-16 h-16 bg-slate-900 dark:bg-lime-500 rounded-[2rem] flex items-center justify-center shadow-2xl border-[6px] border-slate-50 dark:border-slate-950 transform transition-all active:scale-90 hover:rotate-12">
                <svg class="w-8 h-8 text-lime-400 dark:text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </a>
            <span class="text-[9px] font-black uppercase tracking-widest text-slate-900 dark:text-white mt-2">Explore</span>
        </div>

        <a href="#" class="flex flex-col items-center gap-1 group transition-all duration-300">
            <div class="p-2 rounded-2xl transition-all text-slate-400 dark:text-slate-500 hover:text-lime-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <span class="text-[9px] font-black uppercase tracking-tighter text-slate-400">Hub</span>
        </a>

        <a href="#" class="flex flex-col items-center gap-1 group transition-all duration-300">
            <div class="p-2 rounded-2xl transition-all text-slate-400 dark:text-slate-500 hover:text-lime-500">
                <div class="w-6 h-6 rounded-lg border-2 border-slate-300 dark:border-slate-700 overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=bef264&color=1a2e05" class="w-full h-full object-cover">
                </div>
            </div>
            <span class="text-[9px] font-black uppercase tracking-tighter text-slate-400">Me</span>
        </a>

    </div>
</nav>
