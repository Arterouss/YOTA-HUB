<nav x-data="{ userMenuOpen: false, notificationsOpen: false }"
     class="sticky top-0 z-[60] px-4 py-3 transition-all duration-500
            bg-white/80 dark:bg-slate-900/90 backdrop-blur-xl
            border-b-2 border-lime-500/20 dark:border-lime-400/10 shadow-lg">
    <div class="max-w-[1600px] mx-auto flex justify-between items-center">

        <div class="flex items-center gap-6">
            <a href="{{ route('admin.super.index') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-slate-900 dark:bg-lime-500 rounded-xl flex items-center justify-center shadow-2xl transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                    <span class="text-lime-400 dark:text-slate-900 font-heading text-xl">S</span>
                </div>
                <div class="hidden sm:flex flex-col">
                    <span class="font-heading text-lg tracking-tighter text-slate-900 dark:text-white leading-none uppercase">Super Panel</span>
                    <span class="text-[8px] font-black text-lime-600 dark:text-lime-400 uppercase tracking-[0.3em]">Root Access Enabled</span>
                </div>
            </a>

            <div class="hidden lg:flex items-center gap-4 pl-6 border-l border-slate-200 dark:border-slate-800">
                <div class="flex flex-col">
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">System Status</span>
                    <div class="flex items-center gap-1.5">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400">All Systems Operational</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-4">

            <button @click="darkMode = !darkMode"
                    class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-lime-400 hover:bg-lime-100 dark:hover:bg-lime-900/40 transition-all duration-300 active:scale-90">
                <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707.707M12 8a4 4 0 100 8 4 4 0 000-8z" /></svg>
            </button>

            <div class="relative">
                <button @click="notificationsOpen = !notificationsOpen" @click.away="notificationsOpen = false"
                        class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:text-lime-600 dark:hover:text-lime-400 transition-all active:scale-90">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                    <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-slate-900 shadow-sm"></span>
                </button>

                <div x-show="notificationsOpen" x-transition class="absolute right-0 mt-3 w-80 glass-card rounded-2xl p-4 shadow-2xl border border-lime-100 dark:border-lime-900 text-sm" style="display: none;">
                    <p class="font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-800 pb-2 mb-2">Pemberitahuan Sistem</p>
                    <div class="text-xs text-slate-500 dark:text-slate-400 italic">Tidak ada notifikasi baru hari ini.</div>
                </div>
            </div>

            <div class="relative ml-2 border-l border-slate-200 dark:border-slate-800 pl-4">
                <button @click="userMenuOpen = !userMenuOpen" @click.away="userMenuOpen = false"
                        class="flex items-center gap-3 group focus:outline-none">
                    <div class="text-right hidden md:block">
                        <p class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-tighter">{{ Auth::user()->name }}</p>
                        <p class="text-[9px] font-bold text-lime-600 dark:text-lime-400 uppercase tracking-[0.2em]">Superadmin Access</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl overflow-hidden border-2 border-lime-400 shadow-md group-hover:scale-110 group-hover:rotate-2 transition-all duration-300">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=bef264&color=1a2e05&bold=true" alt="Avatar">
                    </div>
                </button>

                <div x-show="userMenuOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                     class="absolute right-0 mt-3 w-60 glass-card rounded-2xl p-2 shadow-2xl border border-lime-100 dark:border-lime-900" style="display: none;">

                    <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800 mb-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase">Signed in as</p>
                        <p class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <a href="#" class="flex items-center gap-3 p-3 rounded-xl hover:bg-lime-50 dark:hover:bg-lime-900/30 text-xs font-bold text-slate-700 dark:text-slate-200 transition-colors group">
                        <svg class="w-4 h-4 text-lime-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2.5"/></svg>
                        Admin Profile Settings
                    </a>

                    <hr class="my-1 border-slate-100 dark:border-slate-800">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 text-xs font-bold text-red-600 transition-colors group">
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="2.5"/></svg>
                            Log Out Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
