<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('seminar_quizzes');
    }

    public function down(): void
    {
        Schema::create('seminar_quizzes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('seminar_id')->constrained('seminars')->onDelete('cascade');
            $table->text('question');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c');
            $table->string('option_d');
            $table->string('correct_answer');
            $table->integer('points')->default(10);
            $table->timestamps();
        });
    }
};
