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
    Schema::create('seminar_user', function (Blueprint $table) {
        $table->id();
        $table->foreignUuid('seminar_id')->constrained()->onDelete('cascade');
        $table->foreignUuid('user_id')->constrained()->onDelete('cascade');

        // Tracking Progress & Points (Metrik Kesiapan)
        $table->boolean('is_attended')->default(false);
        $table->integer('quiz_score')->default(0);
        $table->integer('total_points')->default(0); // Akumulasi poin untuk naik ke Layer 2
        $table->timestamp('registered_at')->useCurrent();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminar_user');
    }
};
