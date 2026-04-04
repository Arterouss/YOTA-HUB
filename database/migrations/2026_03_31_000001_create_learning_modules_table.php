<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 3/31/2026 Edit Bayu - Migration baru untuk fitur Modul E-Learning Layer 1
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_modules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable(); // Gambar cover modul
            $table->string('category')->default('umum'); // Misal: teknologi, inovasi, dll
            $table->integer('order')->default(0); // Urutan tampil di daftar
            $table->enum('status', ['published', 'archived'])->default('published');
            $table->integer('total_xp')->default(0); // Total XP jika selesaikan semua materi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_modules');
    }
};
