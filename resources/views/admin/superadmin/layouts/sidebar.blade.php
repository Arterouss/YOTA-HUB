<div class="flex flex-col h-full bg-[#0F172A] transition-all duration-300">

    <div class="h-20 flex items-center px-6 border-b border-white/10">
        <div class="flex-shrink-0 w-10 h-10 bg-[#BEF264] rounded-xl flex items-center justify-center shadow-lg shadow-lime-500/20">
            <span class="text-slate-900 font-bold text-xl uppercase">Y</span>
        </div>
        <div x-show="sidebarOpen" x-transition class="ml-4 overflow-hidden whitespace-nowrap">
            <h1 class="text-white font-bold text-base tracking-tight uppercase leading-none">YOTA HUB</h1>
            <p class="text-[#BEF264] text-[9px] font-black uppercase tracking-widest mt-1">Management</p>
        </div>
    </div>

    <nav class="flex-1 px-4 py-8 space-y-1 overflow-y-auto">

        <p x-show="sidebarOpen" class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-3">Core Panel</p>

        <a href="#"
           class="flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all group
                  {{ request()->is('admin/dashboard*') ? 'bg-[#BEF264] text-slate-900 shadow-md' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span x-show="sidebarOpen" class="font-bold text-sm">Dashboard</span>
        </a>

        <div class="pt-6">
            <p x-show="sidebarOpen" class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-3">Master Systems</p>

            <a href="#"
               class="flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all group
                      {{ request()->is('admin/master*') ? 'bg-[#BEF264] text-slate-900 shadow-md' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span x-show="sidebarOpen" class="font-bold text-sm">Master Data</span>
            </a>

            <a href="#" class="flex items-center gap-4 px-4 py-3.5 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all group">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 15.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span x-show="sidebarOpen" class="font-bold text-sm">Users</span>
            </a>
        </div>

        <div class="pt-6">
            <p x-show="sidebarOpen" class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-3">Security</p>

            <a href="#" class="flex items-center gap-4 px-4 py-3.5 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all group">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04L3 9.745c0 4.78 3.339 8.887 8 10.056 4.661-1.169 8-5.276 8-10.056l-1.382-3.717z" />
                </svg>
                <span x-show="sidebarOpen" class="font-bold text-sm">Permissions</span>
            </a>
        </div>
    </nav>

    <div class="p-4 bg-black/20">
        <button @click="sidebarOpen = !sidebarOpen"
                class="w-full flex items-center justify-center p-3 rounded-xl bg-white/5 text-slate-400 hover:text-[#BEF264] hover:bg-white/10 transition-all active:scale-95">
            <svg :class="sidebarOpen ? '' : 'rotate-180'" class="w-5 h-5 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
            <span x-show="sidebarOpen" class="ml-3 text-xs font-bold uppercase tracking-widest">Collapse</span>
        </button>
    </div>

</div>
