<nav class="fixed bottom-0 left-0 z-[100] w-full bg-white/80 dark:bg-slate-900/90 backdrop-blur-xl border-t border-lime-200/50 dark:border-lime-900/50 px-6 py-3 shadow-[0_-10px_25px_-5px_rgba(0,0,0,0.1)]">
    <div class="flex justify-between items-center max-w-md mx-auto">

        <a href="#"
           class="flex flex-col items-center gap-1 group">
            <div class="p-2 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-lime-500 text-slate-900' : 'text-slate-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
            </div>
            <span class="text-[9px] font-black uppercase tracking-tighter {{ request()->routeIs('admin.dashboard') ? 'text-lime-600' : 'text-slate-400' }}">Home</span>
        </a>

        <a href="#"
           class="flex flex-col items-center gap-1 group">
            <div class="p-2 rounded-xl transition-all {{ request()->routeIs('admin.master*') ? 'bg-lime-500 text-slate-900' : 'text-slate-400' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
            </div>
            <span class="text-[9px] font-black uppercase tracking-tighter {{ request()->routeIs('admin.master*') ? 'text-lime-600' : 'text-slate-400' }}">Master</span>
        </a>

        <a href="#" class="relative -mt-10">
            <div class="w-14 h-14 bg-slate-900 dark:bg-lime-500 rounded-2xl flex items-center justify-center shadow-2xl border-4 border-white dark:border-slate-900 transform transition-transform active:scale-90">
                <svg class="w-7 h-7 text-lime-400 dark:text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 15.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </div>
        </a>

        <a href="#" class="flex flex-col items-center gap-1">
            <div class="p-2 rounded-xl text-slate-400 active:text-lime-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04L3 9.745c0 4.78 3.339 8.887 8 10.056 4.661-1.169 8-5.276 8-10.056l-1.382-3.717z" /></svg>
            </div>
            <span class="text-[9px] font-black uppercase tracking-tighter text-slate-400">Security</span>
        </a>

        <a href="#" class="flex flex-col items-center gap-1">
            <div class="p-2 rounded-xl text-slate-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
            </div>
            <span class="text-[9px] font-black uppercase tracking-tighter text-slate-400">Profile</span>
        </a>

    </div>
</nav>
