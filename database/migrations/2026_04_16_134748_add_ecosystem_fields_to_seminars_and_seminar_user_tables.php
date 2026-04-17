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
            $table->integer('quota_remaining')->default(0);
            $table->enum('status', ['Open', 'Full', 'Closed'])->default('Open');
            $table->enum('payment_type', ['free', 'paid'])->default('free');
            $table->integer('price')->default(0);
        });

        Schema::table('seminar_user', function (Blueprint $table) {
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->nullable();
            $table->boolean('is_feedback_filled')->default(false);
            $table->integer('point_earned')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seminars', function (Blueprint $table) {
            $table->dropColumn(['quota_remaining', 'status', 'payment_type', 'price']);
        });

        Schema::table('seminar_user', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'is_feedback_filled', 'point_earned']);
        });
    }
};
