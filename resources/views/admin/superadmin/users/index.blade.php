@extends('admin.superadmin.layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-heading text-3xl text-slate-900 dark:text-white uppercase">User Management</h1>
            <p class="text-sm font-bold text-slate-500 dark:text-slate-400">Kelola semua pengguna YOTA HUB.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="bg-[#BEF264] text-slate-900 px-6 py-3 rounded-xl font-heading text-xs tracking-widest uppercase shadow-lg shadow-lime-500/20 hover:scale-105 transition">
            + Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
    <div class="bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 px-6 py-4 rounded-xl text-sm font-bold border border-emerald-200 dark:border-emerald-800">
        {{ session('success') }}
    </div>
    @endif
    
    @if(session('error'))
    <div class="bg-red-100 dark:bg-red-900/30 text-red-600 px-6 py-4 rounded-xl text-sm font-bold border border-red-200 dark:border-red-800">
        {{ session('error') }}
    </div>
    @endif

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
                    @foreach($users as $user)
                    <tr class="hover:bg-lime-50/30 dark:hover:bg-lime-900/10 transition-colors group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-200 dark:bg-slate-700 overflow-hidden">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=bef264&color=1a2e05" alt="Avatar">
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tighter">{{ $user->name }}</p>
                                    <p class="text-[10px] font-bold text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-xs font-black uppercase text-lime-600">
                            @if($user->roles->count() > 0)
                                {{ $user->roles->pluck('name')->implode(', ') }}
                            @else
                                Member
                            @endif
                        </td>
                        <td class="px-8 py-6">
                            @if($user->email_verified_at)
                                <span class="px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 text-[9px] font-black uppercase tracking-widest">Active</span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-orange-100 dark:bg-orange-900/30 text-orange-600 text-[9px] font-black uppercase tracking-widest">Pending</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-right">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-500 transition-colors p-2 bg-slate-50 dark:bg-slate-800 rounded-lg" title="Delete User">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
