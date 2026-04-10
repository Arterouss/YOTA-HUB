<div class="flex flex-col h-full bg-white dark:bg-slate-950 transition-all duration-500 border-r border-lime-100 dark:border-lime-900/30">

    <div class="p-6 border-b border-lime-50 dark:border-slate-900">
        <div class="flex items-center gap-4 mb-4">
            <div class="relative">
                <div class="w-12 h-12 rounded-2xl border-2 border-slate-900 dark:border-lime-400 p-0.5 shadow-lg">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0f172a&color=bef264&bold=true"
                         class="w-full h-full rounded-xl object-cover" alt="Avatar">
                </div>
                <div class="absolute -bottom-1 -right-1 bg-lime-500 dark:bg-slate-900 w-5 h-5 rounded-lg flex items-center justify-center border-2 border-white dark:border-slate-900 shadow-sm">
                    <span class="text-[8px] font-black text-slate-900 dark:text-lime-400 uppercase">ADM</span>
                </div>
            </div>
            <div x-show="sidebarOpen" x-transition class="overflow-hidden">
                <h3 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tighter truncate">{{ Auth::user()->name }}</h3>
                <p class="text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest">Administrator</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto custom-scrollbar">

        <p x-show="sidebarOpen" class="px-4 text-[9px] font-black text-lime-600 uppercase tracking-[0.2em] mb-4">Admin Workspace</p>

        <a href="{{ route('admin.learning.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all group {{ request()->is('admin/learning*') ? 'bg-slate-900 text-lime-400 shadow-xl shadow-slate-900/20' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
            <span x-show="sidebarOpen" class="font-bold text-sm tracking-tight">Kelola Modul E-Learning</span>
        </a>

        <a href="{{ route('admin.certificates.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all group {{ request()->is('admin/certificates*') ? 'bg-slate-900 text-lime-400 shadow-xl shadow-slate-900/20' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            <span x-show="sidebarOpen" class="font-bold text-sm tracking-tight">Penilaian & Piagam</span>
        </a>

        <div class="pt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-4 px-4 py-3.5 rounded-2xl text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all group">
                    <svg class="w-6 h-6 flex-shrink-0 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span x-show="sidebarOpen" class="font-bold text-sm tracking-tight italic">End Session</span>
                </button>
            </form>
        </div>
    </nav>

    <div class="p-4 border-t border-lime-50 dark:border-slate-900 bg-lime-50/30 dark:bg-slate-900/30">
        <button @click="sidebarOpen = !sidebarOpen"
                class="w-full flex items-center justify-center p-3 rounded-xl bg-slate-900 dark:bg-lime-500 text-lime-400 dark:text-slate-900 transition-all active:scale-95 shadow-lg shadow-lime-500/10">
            <svg :class="sidebarOpen ? '' : 'rotate-180'" class="w-5 h-5 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </button>
    </div>

</div>
