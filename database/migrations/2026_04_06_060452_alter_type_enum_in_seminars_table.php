<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE seminars MODIFY COLUMN type ENUM('online', 'offline', 'hybrid', 'E-Learning') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE seminars MODIFY COLUMN type ENUM('online', 'offline', 'hybrid') NOT NULL");
    }
};
