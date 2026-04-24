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
        Schema::table('seminars', function (Blueprint $table) {
            if (Schema::hasColumn('seminars', 'quota') && !Schema::hasColumn('seminars', 'quota_total')) {
                $table->renameColumn('quota', 'quota_total');
            }
        });

        if (Schema::hasColumn('seminars', 'payment_type') && !Schema::hasColumn('seminars', 'seminar_type')) {
            DB::statement("ALTER TABLE seminars CHANGE payment_type seminar_type ENUM('free', 'paid') NOT NULL DEFAULT 'free'");
        }

        Schema::table('seminar_user', function (Blueprint $table) {
            if (Schema::hasColumn('seminar_user', 'is_attended') && !Schema::hasColumn('seminar_user', 'attendance_status')) {
                $table->renameColumn('is_attended', 'attendance_status');
            }
            if (Schema::hasColumn('seminar_user', 'is_feedback_filled') && !Schema::hasColumn('seminar_user', 'feedback_status')) {
                $table->renameColumn('is_feedback_filled', 'feedback_status');
            }
            if (!Schema::hasColumn('seminar_user', 'quiz_status')) {
                $table->boolean('quiz_status')->default(false)->after('feedback_status');
            }
            
            if (!Schema::hasColumn('seminar_user', 'payment_status')) {
                $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending')->after('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('seminars', 'seminar_type') && !Schema::hasColumn('seminars', 'payment_type')) {
            DB::statement("ALTER TABLE seminars CHANGE seminar_type payment_type ENUM('free', 'paid') NOT NULL DEFAULT 'free'");
        }

        Schema::table('seminars', function (Blueprint $table) {
            if (Schema::hasColumn('seminars', 'quota_total')) {
                $table->renameColumn('quota_total', 'quota');
            }
        });

        Schema::table('seminar_user', function (Blueprint $table) {
            if (Schema::hasColumn('seminar_user', 'attendance_status')) {
                $table->renameColumn('attendance_status', 'is_attended');
            }
            if (Schema::hasColumn('seminar_user', 'feedback_status')) {
                $table->renameColumn('feedback_status', 'is_feedback_filled');
            }
            if (Schema::hasColumn('seminar_user', 'quiz_status')) {
                $table->dropColumn('quiz_status');
            }
        });
    }
};
