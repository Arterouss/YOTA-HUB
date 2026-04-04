<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 3/31/2026 Edit Bayu - Migration untuk menyimpan progress/Competency Score peserta per materi
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_learning_progress', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('learning_material_id')->constrained()->onDelete('cascade');
            $table->integer('xp_earned')->default(0); // XP yang didapat dari materi ini
            $table->timestamp('completed_at')->nullable(); // Waktu penandaan selesai
            $table->timestamps();

            // Satu user hanya boleh punya 1 progress per materi (anti-cheating)
            $table->unique(['user_id', 'learning_material_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_learning_progress');
    }
};
