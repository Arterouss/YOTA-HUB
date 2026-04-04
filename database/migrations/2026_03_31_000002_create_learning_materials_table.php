<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 3/31/2026 Edit Bayu - Migration materi/video yang berada dalam satu Modul
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_materials', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('learning_module_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['video', 'article', 'pdf'])->default('article');
            $table->text('content_url')->nullable();  // Link YouTube/embed, URL PDF, dll
            $table->longText('content_body')->nullable(); // Isi artikel teks jika type=article
            $table->integer('order')->default(0);   // Urutan dalam modul
            $table->integer('xp_reward')->default(10); // XP peserta dapat jika tandai selesai
            $table->integer('duration_minutes')->nullable(); // Estimasi waktu baca/tonton
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_materials');
    }
};
