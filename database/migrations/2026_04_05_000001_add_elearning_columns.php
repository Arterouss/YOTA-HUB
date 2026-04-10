<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 4/5/2026 Edit Bayu - Menambah kolom baru untuk fitur E-Learning (pengumpulan tugas & piagam)
     */
    public function up(): void
    {
        // Alter tabel seminar_user: tambah kolom submission & certificate
        Schema::table('seminar_user', function (Blueprint $table) {
            $table->string('submission_link')->nullable()->after('total_points');
            $table->text('submission_note')->nullable()->after('submission_link');
            $table->string('certificate_code', 64)->nullable()->unique()->after('submission_note');
            $table->timestamp('certificate_issued_at')->nullable()->after('certificate_code');
        });

        // Alter tabel seminars: tambah kolom grading_type
        Schema::table('seminars', function (Blueprint $table) {
            $table->enum('grading_type', ['auto', 'manual'])->default('auto')->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seminar_user', function (Blueprint $table) {
            $table->dropColumn(['submission_link', 'submission_note', 'certificate_code', 'certificate_issued_at']);
        });

        Schema::table('seminars', function (Blueprint $table) {
            $table->dropColumn('grading_type');
        });
    }
};
