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
        Schema::create('short_courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description');
            $table->enum('course_type', ['free', 'paid'])->default('free');
            $table->string('organizer')->default('YOTA');
            $table->date('duration_start')->nullable();
            $table->date('duration_end')->nullable();
            $table->boolean('certificate_available')->default(false);
            $table->integer('quota_total')->default(0);
            $table->integer('quota_remaining')->default(0);
            $table->integer('price')->default(0);
            $table->enum('status', ['open', 'full', 'closed'])->default('open');
            $table->timestamps();
        });

        Schema::create('course_modules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_id')->constrained('short_courses')->onDelete('cascade');
            $table->string('module_title');
            $table->text('module_description')->nullable();
            $table->enum('content_type', ['video', 'article', 'text'])->default('text');
            $table->string('video_url')->nullable();
            $table->longText('article_content')->nullable();
            $table->longText('text_content')->nullable();
            $table->integer('module_order');
            $table->boolean('has_pretest')->default(false);
            $table->boolean('has_quiz')->default(false);
            $table->boolean('has_posttest')->default(false);
            $table->timestamps();
        });

        Schema::create('course_enrollments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('course_id')->constrained('short_courses')->onDelete('cascade');
            $table->integer('progress_percentage')->default(0);
            $table->enum('status', ['in_progress', 'completed'])->default('in_progress');
            $table->timestamps();
        });

        Schema::create('module_progress', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('module_id')->constrained('course_modules')->onDelete('cascade');
            $table->enum('status', ['not_started', 'in_progress', 'completed'])->default('not_started');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('course_tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('course_id')->constrained('short_courses')->onDelete('cascade');
            $table->string('task_title');
            $table->text('task_description');
            $table->integer('task_point')->default(0);
            $table->enum('submission_type', ['file_upload', 'link_submission'])->default('link_submission');
            $table->timestamps();
        });

        Schema::create('task_submissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('task_id')->constrained('course_tasks')->onDelete('cascade');
            $table->string('submission_file')->nullable();
            $table->string('submission_link')->nullable();
            $table->enum('status', ['submitted', 'reviewed', 'approved'])->default('submitted');
            $table->timestamps();
        });
        
        Schema::create('course_quizzes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('module_id')->constrained('course_modules')->onDelete('cascade');
            $table->string('question');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c');
            $table->string('option_d');
            $table->string('correct_answer');
            $table->integer('points')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_quizzes');
        Schema::dropIfExists('task_submissions');
        Schema::dropIfExists('course_tasks');
        Schema::dropIfExists('module_progress');
        Schema::dropIfExists('course_enrollments');
        Schema::dropIfExists('course_modules');
        Schema::dropIfExists('short_courses');
    }
};
