@php
    // Deklarasi langsung dari Model Seminar
    // Mengambil 3 seminar terbaru yang statusnya aktif
    $latestSeminars = \App\Models\Seminar::where('is_active', true)
                        ->orderBy('event_date', 'asc')
                        ->take(3)
                        ->get();
@endphp

<section class="mt-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Seminar & Webinar Terbaru</h2>
            <p class="text-sm text-gray-500">Membangun fondasi pengetahuan di Layer 1.</p>
        </div>
        <a href="{{ route('member.seminars.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
            Lihat Semua &rarr;
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($latestSeminars as $seminar)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                {{-- Poster Seminar --}}
                <div class="relative h-40 bg-gray-200">
                    @if($seminar->poster_path)
                        <img src="{{ asset('storage/' . $seminar->poster_path) }}" class="w-full h-full object-cover" alt="Poster">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <div class="absolute top-3 left-3">
                        <span class="px-2 py-1 text-xs font-bold rounded-lg uppercase {{ $seminar->type == 'online' ? 'bg-blue-500 text-white' : 'bg-emerald-500 text-white' }}">
                            {{ $seminar->type }}
                        </span>
                    </div>
                </div>

                {{-- Konten Singkat --}}
                <div class="p-5">
                    <p class="text-xs text-blue-600 font-bold mb-1">
                        {{ \Carbon\Carbon::parse($seminar->event_date)->format('d M Y') }}
                    </p>
                    <h4 class="font-bold text-gray-900 line-clamp-1">{{ $seminar->title }}</h4>
                    <p class="text-gray-500 text-xs mt-2 line-clamp-2">{{ Str::limit($seminar->description, 80) }}</p>

                    <a href="{{ route('member.seminars.show', $seminar->slug) }}" class="mt-4 block w-full text-center py-2 bg-slate-900 text-white text-xs font-bold rounded-lg hover:bg-slate-800 transition">
                        Daftar Event
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 py-10 text-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                <p class="text-gray-500 text-sm">Belum ada jadwal seminar terbaru.</p>
            </div>
        @endforelse
    </div>
</section>
