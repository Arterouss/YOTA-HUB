<nav x-data="{ mobileMenuOpen: false }"
     class="sticky top-0 z-50 px-6 py-4 transition-all duration-300
            bg-white/80 dark:bg-slate-900/90 backdrop-blur-xl
            border-b border-lime-200/50 dark:border-lime-900/50 shadow-sm">
    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <a href="/" class="flex items-center gap-3 group">
            <div class="w-10 h-10 bg-lime-500 rounded-xl flex items-center justify-center shadow-lg transform rotate-12 group-hover:rotate-0 transition-transform duration-300">
                <span class="text-white font-heading text-xl">Y</span>
            </div>
            <div class="flex flex-col">
                <span class="font-heading text-xl tracking-tighter text-slate-900 dark:text-white leading-none">YOTA HUB</span>
                <span class="text-[8px] font-black text-lime-600 dark:text-lime-400 uppercase tracking-[0.2em]">Digital Ecosystem</span>
            </div>
        </a>

        <div class="hidden md:flex items-center gap-8">
            <a href="/" class="text-sm font-bold text-slate-600 dark:text-lime-100/70 hover:text-lime-600 dark:hover:text-lime-400 transition">Home</a>
            <a href="#" class="text-sm font-bold text-slate-600 dark:text-lime-100/70 hover:text-lime-600 dark:hover:text-lime-400 transition">Courses</a>
            <a href="#" class="text-sm font-bold text-slate-600 dark:text-lime-100/70 hover:text-lime-600 dark:hover:text-lime-400 transition">Projects</a>
            <a href="#" class="text-sm font-bold text-slate-600 dark:text-lime-100/70 hover:text-lime-600 dark:hover:text-lime-400 transition">Events</a>
        </div>

        <div class="flex items-center gap-3">
            <button @click="darkMode = !darkMode"
                    class="p-2.5 rounded-xl bg-lime-100 dark:bg-lime-900/40 text-lime-700 dark:text-lime-400
                           hover:scale-110 active:scale-95 transition-all border border-transparent dark:border-lime-800/50">
                <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707.707M12 8a4 4 0 100 8 4 4 0 000-8z" /></svg>
                <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
            </button>

            <div class="hidden sm:flex items-center gap-4 ml-2">
                <a href="/login" class="text-xs font-black text-slate-500 dark:text-slate-400 hover:text-lime-600 dark:hover:text-lime-400 uppercase tracking-widest transition">Login</a>
                <a href="/register" class="btn-lemon px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-tight shadow-md">Register</a>
            </div>

            <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300
                           active:bg-lime-100 dark:active:bg-lime-900 transition-colors border border-transparent dark:border-slate-700">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
    </div>

    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-10"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-10"
         class="md:hidden absolute top-[calc(100%+1px)] left-0 w-full bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl border-b border-lime-200 dark:border-lime-900 p-8 shadow-2xl space-y-6"
         style="display: none;">

        <div class="flex flex-col gap-5">
            <a href="/" class="text-xl font-bold text-slate-900 dark:text-white flex justify-between items-center group">
                Home <span class="text-lime-500 opacity-0 group-hover:opacity-100 transition">→</span>
            </a>
            <a href="#" class="text-xl font-bold text-slate-900 dark:text-white flex justify-between items-center group">
                Courses <span class="text-lime-500 opacity-0 group-hover:opacity-100 transition">→</span>
            </a>
            <a href="#" class="text-xl font-bold text-slate-900 dark:text-white flex justify-between items-center group">
                Projects <span class="text-lime-500 opacity-0 group-hover:opacity-100 transition">→</span>
            </a>
        </div>

        <div class="grid grid-cols-2 gap-4 pt-6 border-t border-slate-100 dark:border-slate-800">
            <a href="/login" class="text-center py-4 rounded-2xl border-2 border-lime-200 dark:border-lime-900 font-bold text-slate-600 dark:text-white text-sm active:bg-slate-50 dark:active:bg-slate-800 transition">
                Login
            </a>
            <a href="/register" class="text-center py-4 rounded-2xl btn-lemon font-bold text-sm shadow-lg active:scale-95 transition">
                Register
            </a>
        </div>
    </div>
</nav>
