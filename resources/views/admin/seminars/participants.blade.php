@extends('admin.layouts.app')

@section('title', 'Daftar Pendaftar: ' . $seminar->title)

@section('content')
<div class="sm:flex sm:items-center sm:justify-between mb-8">
    <div>
        <a href="{{ route('admin.seminars.index') }}" class="text-xs font-bold text-slate-500 dark:text-slate-400 hover:text-lime-600 mb-2 inline-block">← KEMBALI KE DAFTAR SEMINAR</a>
        <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Pendaftar: {{ $seminar->title }}</h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
            Tipe Acara: <span class="font-bold text-slate-700">{{ strtoupper($seminar->seminar_type) }}</span> 
            | Harga: <span class="font-bold text-slate-700">Rp{{ number_format($seminar->price, 0, ',', '.') }}</span>
        </p>
    </div>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 font-bold">
    {{ session('success') }}
</div>
@endif

<div class="bg-white dark:bg-slate-900 shadow-sm border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-800">
        <thead class="bg-slate-50 dark:bg-slate-800">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Peserta</th>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider">Email</th>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status Pembayaran</th>
                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider">Poin & Kuis</th>
                <th class="px-6 py-4 text-right text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-wider">Aksi Verifikasi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 dark:divide-slate-800 bg-white dark:bg-slate-900">
            @forelse($participants as $user)
            <tr>
                <td class="px-6 py-4">
                    <div class="text-sm font-bold text-slate-900 dark:text-white">{{ $user->name }}</div>
                </td>
                <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">
                    {{ $user->email }}
                </td>
                <td class="px-6 py-4">
                    @if($user->pivot->payment_status == 'paid')
                        <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-emerald-100 text-emerald-800">
                            LUNAS ✅
                        </span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-orange-100 text-orange-800">
                            PENDING ⏳
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">
                    <div class="font-bold text-lime-600">{{ $user->pivot->point_earned }} XP</div>
                    <div class="text-xs">Kehadiran: {{ $user->pivot->attendance_status ? '✅' : '❌' }}</div>
                </td>
                <td class="px-6 py-4 text-right text-sm font-medium">
                    @if($user->pivot->payment_status == 'pending')
                        <form action="{{ route('admin.seminars.verify', [$seminar->id, $user->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-lime-400 text-slate-900 dark:text-white hover:bg-lime-500 rounded-lg text-xs font-bold transition-colors" onclick="return confirm('Apakah Anda yakin dana dari peserta ini sudah masuk dan ingin diverifikasi LUNAS?');">
                                Verifikasi Pembayaran
                            </button>
                        </form>
                    @else
                        <span class="text-xs font-bold text-slate-400">Sudah Diverifikasi</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400 border-2 border-dashed border-slate-200 dark:border-slate-700">
                    Belum ada pendaftar untuk acara ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
