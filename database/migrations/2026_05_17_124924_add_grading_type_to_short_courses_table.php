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
        Schema::table('short_courses', function (Blueprint $table) {
            $table->enum('grading_type', ['auto', 'manual'])->default('auto')->after('course_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('short_courses', function (Blueprint $table) {
            $table->dropColumn('grading_type');
        });
    }
};
