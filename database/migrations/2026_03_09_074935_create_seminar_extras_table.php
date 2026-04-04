<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    // 1. Tabel Soal Kuis (Custom per Seminar)
    Schema::create('seminar_quizzes', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->foreignUuid('seminar_id')->constrained()->onDelete('cascade');
        $table->text('question');
        $table->string('option_a');
        $table->string('option_b');
        $table->string('option_c');
        $table->string('option_d');
        $table->char('correct_answer', 1); // A, B, C, atau D
        $table->integer('points')->default(10); // Poin per soal
        $table->timestamps();
    });

    // 2. Tabel Feedback / Evaluasi
    Schema::create('seminar_feedback', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->foreignUuid('seminar_id')->constrained()->onDelete('cascade');
        $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
        $table->integer('rating'); // 1-5 bintang
        $table->text('message'); // Testimoni/Kesan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminar_extras');
    }
};
