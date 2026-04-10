<?php

namespace Database\Seeders;

use App\Models\Seminar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LearningModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 3/31/2026 Edit Bayu - Seeder Dummy untuk Modul E-Learning menggunakan tabel Seminar

        Seminar::create([
            'id' => (string) Str::uuid(),
            'title' => 'Pengantar Inovasi Dasar',
            'slug' => 'pengantar-inovasi-dasar',
            'description' => "Modul ini adalah langkah awal kamu untuk memahami pola pikir inovator sejati.\n\nJangan membuat solusi sebelum kamu mengkonfirmasi bahwa masalahnya benar-benar ada di masyarakat.\n\nLangkah-langkah validasi:\n1. Wawancara target pengguna.\n2. Buat survei.\n3. Rilis purwarupa (MVP) secepat mungkin.",
            'type' => 'E-Learning',
            'event_date' => now(),
            'location' => 'Online',
            'poster_path' => null,
            'recording_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Video Dummy
            'attachment_link' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', // PDF Dummy
            'quota' => 9999,
            'is_active' => true,
        ]);

        Seminar::create([
            'id' => (string) Str::uuid(),
            'title' => 'Teknik Presentasi & Pitching',
            'slug' => 'teknik-presentasi-pitching',
            'description' => "Pelajari cara mempresentasikan ide inovasimu di depan juri atau investor dengan meyakinkan dan terstruktur.\n\nSimak video di atas dengan teliti dan baca panduan tambahan di tombol PDF.",
            'type' => 'E-Learning',
            'event_date' => now(),
            'location' => 'Online',
            'poster_path' => null,
            'recording_link' => 'https://youtu.be/j5sIs_aIcyk', 
            'attachment_link' => null,
            'quota' => 9999,
            'is_active' => true,
        ]);
    }
}
