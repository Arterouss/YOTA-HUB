@extends('admin.superadmin.layouts.app')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-lime-600 mb-2">
                <a href="{{ route('admin.super.index') }}" class="hover:text-lime-500 transition">Core Panel</a>
                <span class="text-slate-300 dark:text-slate-700">/</span>
                <span class="text-slate-900 dark:text-white">Master Systems</span>
            </nav>
            <h1 class="font-heading text-3xl md:text-4xl text-slate-900 dark:text-white leading-none uppercase">
                Master <span class="text-lime-500 dark:text-lime-400">Control</span> Center
            </h1>
            <p class="text-sm font-bold text-slate-500 dark:text-slate-400 mt-2">
                Workspace khusus manajemen infrastruktur digital YOTA HUB.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button class="bg-white dark:bg-slate-800 p-3 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm hover:border-lime-400 transition">
                <svg class="w-5 h-5 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
            </button>
            <button class="btn-lemon px-6 py-3 rounded-xl font-heading text-xs tracking-widest uppercase shadow-lg shadow-lime-500/20">
                Generate Report
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="glass-panel rounded-[2rem] p-6 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-lime-500/10 rounded-full blur-2xl group-hover:bg-lime-500/20 transition"></div>
            <div class="relative z-10">
                <div class="w-12 h-12 rounded-2xl bg-lime-100 dark:bg-lime-900/30 flex items-center justify-center mb-4 border border-lime-200 dark:border-lime-800">
                    <svg class="w-6 h-6 text-lime-600 dark:text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 15.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <span class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">Total Users</span>
                <span class="text-3xl font-heading text-slate-900 dark:text-white">1,240</span>
                <div class="mt-2 flex items-center gap-1 text-[10px] font-bold text-emerald-500 uppercase">
                    <span>↑ 12%</span>
                    <span class="text-slate-400 dark:text-slate-600 tracking-normal">this month</span>
                </div>
            </div>
        </div>

        <div class="glass-panel rounded-[2rem] p-6 relative overflow-hidden group">
            <div class="relative z-10">
                <div class="w-12 h-12 rounded-2xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mb-4 border border-blue-200 dark:border-blue-800">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                </div>
                <span class="block text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-1">Active Projects</span>
                <span class="text-3xl font-heading text-slate-900 dark:text-white">48</span>
                <div class="mt-2 text-[10px] font-bold text-slate-400 dark:text-slate-600 uppercase">Across 5 Categories</div>
            </div>
        </div>

        </div>

    <div class="glass-panel rounded-[2.5rem] overflow-hidden shadow-2xl">
        <div class="p-8 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <h3 class="font-heading text-xl text-slate-900 dark:text-white uppercase tracking-tight">Global User Database</h3>
            <div class="relative">
                <input type="text" placeholder="Search user ID or name..."
                    class="bg-slate-50 dark:bg-slate-900 border-2 border-slate-100 dark:border-slate-800 rounded-xl px-10 py-2 text-xs font-bold focus:border-lime-500 focus:ring-0 transition w-64">
                <svg class="absolute left-3 top-2.5 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
        </div>

        <div class="p-0 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">Innovator</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">Role</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500">Status</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 dark:text-slate-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    <tr class="hover:bg-lime-50/30 dark:hover:bg-lime-900/10 transition-colors group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-200 dark:bg-slate-700 overflow-hidden">
                                    <img src="https://ui-avatars.com/api/?name=Tri+Febriansah&background=bef264&color=1a2e05" alt="Avatar">
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tighter">Tri Febriansah</p>
                                    <p class="text-[10px] font-bold text-slate-400">tri@yotahub.id</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-xs font-black uppercase text-lime-600">Superadmin</td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 text-[9px] font-black uppercase tracking-widest">Active</span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <button class="text-slate-400 hover:text-lime-500 transition-colors p-2 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>
                            </button>
                        </td>
                    </tr>
                    </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Showing 1 to 10 of 1,240 Entries</p>
            <div class="flex gap-2">
                <button class="w-8 h-8 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-lime-500 transition">←</button>
                <button class="w-8 h-8 rounded-lg bg-lime-500 text-slate-900 flex items-center justify-center font-bold text-xs">1</button>
                <button class="w-8 h-8 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-400 hover:text-lime-500 transition">→</button>
            </div>
        </div>
    </div>
</div>
@endsection
