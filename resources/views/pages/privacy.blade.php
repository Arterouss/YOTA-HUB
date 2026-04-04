@extends('layouts.guest')


@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <nav class="mb-6 flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-lime-700">
        <a href="{{ route('register') }}" class="hover:text-lime-900 transition">Pendaftaran</a>
        <span>/</span>
        <span class="text-slate-400">Kebijakan Privasi</span>
    </nav>

    <div class="glass-card rounded-[2.5rem] overflow-hidden bg-white/80 shadow-xl">
        <div class="p-8 sm:p-12 border-b border-lime-100 bg-lime-50/50">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="font-heading text-3xl sm:text-4xl text-slate-900 leading-tight">
                        Kebijakan Privasi <br> <span class="text-lime-600">YOTA HUB</span>
                    </h1>
                    <p class="mt-4 text-slate-500 font-medium max-w-xl">
                        Kami menghargai privasi Anda. Dokumen ini menjelaskan bagaimana kami mengelola data Anda dalam ekosistem digital YOTA HUB secara bertanggung jawab.
                    </p>
                </div>
                <span class="hidden sm:block bg-lime-200 text-lime-800 text-[10px] font-black px-4 py-2 rounded-full tracking-tighter">
                    VERSI 1.0
                </span>
            </div>
        </div>

        <div class="p-8 sm:p-12 space-y-10">

            <section class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/3">
                    <h2 class="font-heading text-xl text-lime-800 tracking-tight">Koleksi Data</h2>
                </div>
                <div class="md:w-2/3 text-slate-600 leading-relaxed font-medium">
                    Kami mengumpulkan informasi identitas dasar seperti nama dan alamat email untuk keperluan akses platform, serta data teknis penggunaan guna meningkatkan performa layanan kami.
                </div>
            </section>

            <hr class="border-lime-100">

            <section class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/3">
                    <h2 class="font-heading text-xl text-lime-800 tracking-tight">Tujuan Penggunaan</h2>
                </div>
                <div class="md:w-2/3 text-slate-600 leading-relaxed font-medium">
                    Data yang terkumpul digunakan untuk memverifikasi keanggotaan, mengelola partisipasi program, menerbitkan sertifikat digital, serta memfasilitasi kolaborasi antar pengguna di dalam ekosistem.
                </div>
            </section>

            <hr class="border-lime-100">

            <section class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/3">
                    <h2 class="font-heading text-xl text-lime-800 tracking-tight">Keamanan Data</h2>
                </div>
                <div class="md:w-2/3 text-slate-600 leading-relaxed font-medium">
                    Kami menerapkan standar keamanan digital untuk melindungi informasi Anda dari akses yang tidak sah. Data Anda hanya akan digunakan untuk kepentingan pengembangan kapasitas pemuda di bawah naungan YOTA HUB.
                </div>
            </section>

            <div class="bg-lime-900 text-lime-100 p-6 rounded-3xl mt-8">
                <p class="text-sm font-bold leading-relaxed">
                    Dengan melanjutkan pendaftaran, Anda menyetujui bahwa data yang diberikan adalah benar dan sah untuk digunakan dalam lingkungan operasional YOTA HUB.
                </p>
            </div>
        </div>

        <div class="p-8 bg-slate-50 flex flex-col sm:flex-row justify-between items-center gap-6">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                Pembaruan terakhir: {{ date('d F Y') }}
            </span>
            <a href="{{ route('register') }}" class="btn-lemon px-8 py-3 rounded-2xl font-bold text-sm inline-block text-center w-full sm:w-auto">
                Kembali ke Pendaftaran
            </a>
        </div>
    </div>
</div>
@endsection
