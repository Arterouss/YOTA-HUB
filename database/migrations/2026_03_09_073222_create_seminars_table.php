<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seminars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('speaker')->nullable(); // Narasumber
            $table->text('description');
            $table->dateTime('event_date');
            $table->string('location');
            $table->enum('type', ['online', 'offline', 'hybrid']);

            // --- Fitur Extra YOTA HUB ---
            $table->string('meeting_link')->nullable(); // Zoom/GMeet
            $table->string('pretest_link')->nullable();
            $table->string('posttest_link')->nullable();
            $table->string('quiz_link')->nullable();
            $table->string('game_link')->nullable(); // Kahoot dll
            $table->string('resume_link')->nullable();
            $table->string('attachment_link')->nullable(); // Lampiran buku/materi
            $table->string('evaluation_link')->nullable(); // Angket/Rating
            $table->string('recording_link')->nullable(); // Tayangan ulang

            $table->integer('quota')->default(0);
            $table->string('poster_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seminars');
    }
};
