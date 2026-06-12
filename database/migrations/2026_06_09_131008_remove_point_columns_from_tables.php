<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seminar_user', function (Blueprint $table) {
            if (Schema::hasColumn('seminar_user', 'total_points')) {
                $table->dropColumn('total_points');
            }
            if (Schema::hasColumn('seminar_user', 'point_earned')) {
                $table->dropColumn('point_earned');
            }
            if (Schema::hasColumn('seminar_user', 'quiz_score')) {
                $table->dropColumn('quiz_score');
            }
        });

        Schema::table('course_tasks', function (Blueprint $table) {
            if (Schema::hasColumn('course_tasks', 'task_point')) {
                $table->dropColumn('task_point');
            }
        });

        Schema::table('article_reads', function (Blueprint $table) {
            if (Schema::hasColumn('article_reads', 'point_earned')) {
                $table->dropColumn('point_earned');
            }
        });
    }

    public function down(): void
    {
        // 
    }
};
