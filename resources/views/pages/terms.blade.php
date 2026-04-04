@extends('layouts.guest')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <nav class="mb-6 flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-lime-700">
        <a href="{{ route('register') }}" class="hover:text-lime-900 transition">Pendaftaran</a>
        <span>/</span>
        <span class="text-slate-400">Syarat & Ketentuan</span>
    </nav>

    <div class="glass-card rounded-[2.5rem] overflow-hidden bg-white/80 shadow-xl border-2 border-lime-100">
        <div class="p-8 sm:p-12 border-b border-lime-100 bg-gradient-to-br from-lime-50 to-white">
            <h1 class="font-heading text-3xl sm:text-4xl text-slate-900 leading-tight">
                Syarat dan <br> <span class="text-lime-600">Ketentuan Layanan</span>
            </h1>
            <p class="mt-4 text-slate-500 font-bold text-xs uppercase tracking-widest">
                Terakhir diperbarui: {{ date('d F Y') }}
            </p>
        </div>

        <div class="p-8 sm:p-12">
            <div class="space-y-12">

                <section class="relative">
                    <span class="absolute -left-4 top-0 text-6xl font-heading text-lime-100 -z-10 select-none">01</span>
                    <h2 class="font-heading text-xl text-lime-800 mb-3 pt-4">Penerimaan Layanan</h2>
                    <p class="text-slate-600 leading-relaxed font-medium">
                        Dengan mendaftar di YOTA HUB, Anda setuju untuk terikat oleh seluruh aturan dalam ekosistem ini. Platform ini dirancang sebagai pusat kolaborasi pemuda untuk inovasi sosial dan pengembangan teknologi.
                    </p>
                </section>

                <section class="relative">
                    <span class="absolute -left-4 top-0 text-6xl font-heading text-lime-100 -z-10 select-none">02</span>
                    <h2 class="font-heading text-xl text-lime-800 mb-3 pt-4">Keanggotaan & Data</h2>
                    <p class="text-slate-600 leading-relaxed font-medium">
                        Kami menjamin keamanan informasi Anda melalui sistem perlindungan data internal kami. Anda bertanggung jawab penuh atas kebenaran data yang diberikan dan keamanan akun pribadi Anda.
                    </p>
                </section>

                <section class="relative">
                    <span class="absolute -left-4 top-0 text-6xl font-heading text-lime-100 -z-10 select-none">03</span>
                    <h2 class="font-heading text-xl text-lime-800 mb-3 pt-4">Kode Etik Pengguna</h2>
                    <p class="text-slate-600 leading-relaxed font-medium">
                        Pengguna dilarang melakukan tindakan plagiarisme, menyebarkan konten ilegal, atau menyalahgunakan fitur platform untuk kepentingan di luar misi pengembangan komunitas YOTA HUB.
                    </p>
                </section>

                <div class="bg-lime-50 border-2 border-dashed border-lime-300 p-6 rounded-3xl">
                    <p class="text-sm font-bold text-lime-900 leading-relaxed text-center">
                        Pelanggaran terhadap ketentuan di atas dapat berakibat pada penangguhan hingga penutupan akun secara permanen dari seluruh ekosistem digital kami.
                    </p>
                </div>
            </div>
        </div>

        <div class="p-8 bg-slate-50/50 border-t border-lime-100 flex justify-center">
            <a href="{{ route('register') }}" class="group flex items-center gap-3 font-heading text-sm text-lime-700 hover:text-lime-900 transition">
                <span class="p-2 bg-white rounded-xl shadow-sm group-hover:shadow-md transition">←</span>
                KEMBALI KE PENDAFTARAN
            </a>
        </div>
    </div>
</div>
@endsection
