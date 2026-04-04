<nav x-data="{ searchOpen: false, notifOpen: false }"
     class="sticky top-0 z-50 px-4 py-3 bg-white/80 dark:bg-slate-900/90 backdrop-blur-xl border-b border-lime-200/30 dark:border-lime-900/30 transition-all duration-500">
    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 text-slate-600 dark:text-slate-300 active:scale-90 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
            </button>

            <div class="hidden lg:relative lg:block">
                <input type="text" placeholder="Cari materi atau quest..."
                       class="w-64 bg-slate-100 dark:bg-slate-800 border-none rounded-2xl px-10 py-2.5 text-xs font-bold focus:ring-2 focus:ring-lime-500 transition-all">
                <svg class="absolute left-3 top-2.5 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
        </div>

        <div class="flex items-center gap-2 px-4 py-1.5 bg-orange-50 dark:bg-orange-900/20 border border-orange-100 dark:border-orange-800/50 rounded-2xl shadow-sm animate-bounce-slow">
            <span class="text-lg">🔥</span>
            <div class="flex flex-col">
                <span class="text-[10px] font-black text-orange-600 dark:text-orange-400 uppercase leading-none">7 Day Streak</span>
                <span class="text-[8px] font-bold text-orange-400 dark:text-orange-500/70 uppercase tracking-tighter">Keep it up, Chief!</span>
            </div>
        </div>

        <div class="flex items-center gap-3">

            <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-lime-100 dark:bg-lime-900/30 rounded-xl border border-lime-200 dark:border-lime-800">
                <span class="text-sm">🪙</span>
                <span class="font-heading text-xs text-slate-900 dark:text-white leading-none">1,250</span>
            </div>

            <div class="relative">
                <button @click="notifOpen = !notifOpen" @click.away="notifOpen = false"
                        class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:text-lime-600 transition-all active:scale-90 relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-slate-900"></span>
                </button>

                <div x-show="notifOpen" x-transition class="absolute right-0 mt-3 w-72 glass-card rounded-2xl p-4 shadow-2xl border border-lime-100 dark:border-lime-900" style="display: none;">
                    <h4 class="font-heading text-xs text-slate-900 dark:text-white mb-3">Quest Updates</h4>
                    <div class="space-y-3">
                        <div class="flex gap-3 p-2 rounded-lg bg-lime-50 dark:bg-lime-900/20">
                            <span class="text-xl">🏆</span>
                            <div>
                                <p class="text-[10px] font-bold dark:text-white">Quest Selesai!</p>
                                <p class="text-[9px] text-slate-500">Kamu mendapatkan 50 XP dari Dasar IoT.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button @click="darkMode = !darkMode"
                    class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-lime-400 hover:rotate-12 transition-all">
                <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707.707M12 8a4 4 0 100 8 4 4 0 000-8z" /></svg>
            </button>

        </div>
    </div>
</nav>
