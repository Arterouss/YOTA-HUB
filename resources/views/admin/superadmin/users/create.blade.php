@extends('admin.superadmin.layouts.app')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.users.index') }}" class="w-10 h-10 rounded-xl bg-white dark:bg-slate-800 flex items-center justify-center text-slate-400 hover:text-lime-500 shadow-sm transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <div>
            <h1 class="font-heading text-3xl text-slate-900 dark:text-white uppercase">Tambah Pengguna</h1>
            <p class="text-sm font-bold text-slate-500 dark:text-slate-400">Tambahkan akun baru secara manual ke dalam sistem.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 dark:bg-red-900/30 text-red-600 px-6 py-4 rounded-xl text-sm font-bold border border-red-200 dark:border-red-800">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="glass-panel rounded-[2.5rem] overflow-hidden shadow-2xl p-8">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full bg-slate-50 dark:bg-slate-900 border-2 border-slate-100 dark:border-slate-800 rounded-xl px-4 py-3 text-sm font-bold focus:border-lime-500 focus:ring-0 transition text-slate-900 dark:text-white">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full bg-slate-50 dark:bg-slate-900 border-2 border-slate-100 dark:border-slate-800 rounded-xl px-4 py-3 text-sm font-bold focus:border-lime-500 focus:ring-0 transition text-slate-900 dark:text-white">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">Password</label>
                    <input type="password" name="password" required
                        class="w-full bg-slate-50 dark:bg-slate-900 border-2 border-slate-100 dark:border-slate-800 rounded-xl px-4 py-3 text-sm font-bold focus:border-lime-500 focus:ring-0 transition text-slate-900 dark:text-white">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full bg-slate-50 dark:bg-slate-900 border-2 border-slate-100 dark:border-slate-800 rounded-xl px-4 py-3 text-sm font-bold focus:border-lime-500 focus:ring-0 transition text-slate-900 dark:text-white">
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-500 dark:text-slate-400">Role Akses</label>
                    <select name="role" required class="w-full bg-slate-50 dark:bg-slate-900 border-2 border-slate-100 dark:border-slate-800 rounded-xl px-4 py-3 text-sm font-bold focus:border-lime-500 focus:ring-0 transition text-slate-900 dark:text-white">
                        <option value="basic_member" {{ old('role') == 'basic_member' ? 'selected' : '' }}>Member Biasa (Basic Member)</option>
                        <option value="admin_layer1" {{ old('role') == 'admin_layer1' ? 'selected' : '' }}>Admin (Layer 1)</option>
                        <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                <button type="submit" class="bg-[#BEF264] text-slate-900 px-8 py-4 rounded-xl font-heading text-xs tracking-widest uppercase shadow-lg shadow-lime-500/20 hover:scale-105 transition">
                    Simpan Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
