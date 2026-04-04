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
    Schema::create('users', function (Blueprint $table) {
        // GANTI INI: Menggunakan UUID sebagai Primary Key (ID Utama)
        $table->uuid('id')->primary();

        // Tetap simpan kolom uuid tambahan jika ingin digunakan sebagai public slug
        $table->uuid('uuid')->unique()->nullable();

        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');

        // --- SISTEM LAYER YOTA HUB ---
        $table->integer('level')->default(1);
        $table->enum('member_type', ['basic', 'verified'])->default('basic');

        // --- ASPEK HUKUM & COMPLIANCE ---
        $table->boolean('agreed_to_terms')->default(false);
        $table->timestamp('terms_agreed_at')->nullable();
        $table->string('registration_ip')->nullable();

        // --- ENKRIPSI DATA SENSITIF ---
        $table->text('encrypted_phone')->nullable();

        $table->rememberToken();
        $table->timestamps();
        $table->softDeletes();
    });
Schema::create('password_reset_tokens', function (Blueprint $table) {
        $table->string('email')->primary();
        $table->string('token');
        $table->timestamp('created_at')->nullable();
    });
    
    Schema::create('sessions', function (Blueprint $table) {
        $table->string('id')->primary();
        // SESUAIKAN INI: Karena user.id sekarang UUID (string), foreignId tidak bisa pakai BigInt
        $table->uuid('user_id')->nullable()->index();
        $table->string('ip_address', 45)->nullable();
        $table->text('user_agent')->nullable();
        $table->longText('payload');
        $table->integer('last_activity')->index();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
