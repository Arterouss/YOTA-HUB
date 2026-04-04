<?php

namespace Database\Seeders;

use App\Models\LearningModule;
use App\Models\LearningMaterial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LearningModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 3/31/2026 Edit Bayu - Seeder Dummy untuk Modul E-Learning

        // Modul 1: Pengantar Inovasi
        $module1 = LearningModule::create([
            'id' => (string) Str::uuid(),
            'title' => 'Pengantar Inovasi Dasar',
            'slug' => 'pengantar-inovasi-dasar',
            'description' => 'Modul ini adalah langkah awal kamu untuk memahami pola pikir inovator sejati. Wajib diselesaikan sebelum masuk ke tahap riset.',
            'category' => 'Mindset',
            'order' => 1,
            'status' => 'published',
            'total_xp' => 100, // 50 + 50
        ]);

        // Materi 1.1 (Video)
        LearningMaterial::create([
            'id' => (string) Str::uuid(),
            'learning_module_id' => $module1->id,
            'title' => 'Video: Mindset Seorang Inovator',
            'type' => 'video',
            'content_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Link dummy YouTube
            'order' => 1,
            'xp_reward' => 50,
            'duration_minutes' => 15,
        ]);

        // Materi 1.2 (Artikel)
        LearningMaterial::create([
            'id' => (string) Str::uuid(),
            'learning_module_id' => $module1->id,
            'title' => 'Artikel: Panduan Validasi Ide',
            'type' => 'article',
            'content_body' => "Validasi ide adalah langkah krusial dalam inovasi.\n\nJangan membuat solusi sebelum kamu mengkonfirmasi bahwa masalahnya benar-benar ada di masyarakat.\n\nLangkah-langkah validasi:\n1. Wawancara target pengguna.\n2. Buat survei.\n3. Rilis purwarupa (MVP) secepat mungkin.",
            'order' => 2,
            'xp_reward' => 50,
            'duration_minutes' => 10,
        ]);


        // Modul 2: Teknik Presentasi (Pitching)
        $module2 = LearningModule::create([
            'id' => (string) Str::uuid(),
            'title' => 'Teknik Presentasi & Pitching',
            'slug' => 'teknik-presentasi-pitching',
            'description' => 'Pelajari cara mempresentasikan ide inovasimu di depan juri atau investor dengan meyakinkan dan terstruktur.',
            'category' => 'Skill',
            'order' => 2,
            'status' => 'published',
            'total_xp' => 150, // 100 + 50
        ]);

        // Materi 2.1 (Video YouTube)
        LearningMaterial::create([
            'id' => (string) Str::uuid(),
            'learning_module_id' => $module2->id,
            'title' => 'Cara Membuat Pitch Deck yang Menarik',
            'type' => 'video',
            'content_url' => 'https://youtu.be/j5sIs_aIcyk', // Link contoh
            'order' => 1,
            'xp_reward' => 100,
            'duration_minutes' => 20,
        ]);
        
        // Materi 2.2 (PDF dummy)
        LearningMaterial::create([
            'id' => (string) Str::uuid(),
            'learning_module_id' => $module2->id,
            'title' => 'Buku Saku: Pitching 101',
            'type' => 'pdf',
            'content_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', // Link PDF dummy
            'order' => 2,
            'xp_reward' => 50,
            'duration_minutes' => 30,
        ]);
    }
}
