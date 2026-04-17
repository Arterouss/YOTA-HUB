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
        Schema::create('knowledge_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('category_name');
            $table->string('category_slug')->unique();
            $table->text('category_description')->nullable();
            $table->timestamps();
        });

        Schema::create('knowledge_articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignUuid('author_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('category_id')->nullable()->constrained('knowledge_categories')->onDelete('set null');
            $table->longText('content');
            $table->text('summary')->nullable();
            $table->string('featured_image')->nullable();
            $table->enum('status', ['draft', 'published'])->default('published');
            $table->timestamp('publish_date')->nullable();
            $table->integer('view_count')->default(0);
            $table->integer('reading_time')->default(3); // Menit estimasi
            $table->timestamps();
        });

        Schema::create('article_resources', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('article_id')->constrained('knowledge_articles')->onDelete('cascade');
            $table->string('resource_type'); // misalnya file_attachment, pdf, external_link, youtube
            $table->string('resource_title');
            $table->string('resource_url')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });

        Schema::create('article_comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('article_id')->constrained('knowledge_articles')->onDelete('cascade');
            $table->text('comment_content');
            $table->uuid('parent_comment_id')->nullable();
            $table->timestamps();
        });

        Schema::create('comment_likes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('comment_id')->constrained('article_comments')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('article_reads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignUuid('article_id')->constrained('knowledge_articles')->onDelete('cascade');
            $table->integer('read_duration')->default(0);
            $table->integer('point_earned')->default(0);
            $table->timestamps();
        });
        
        // Menambahkan relasi foreign parent_comment_id 
        Schema::table('article_comments', function (Blueprint $table) {
            $table->foreign('parent_comment_id')->references('id')->on('article_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_reads');
        Schema::dropIfExists('comment_likes');
        Schema::table('article_comments', function(Blueprint $table) {
            $table->dropForeign(['parent_comment_id']);
        });
        Schema::dropIfExists('article_comments');
        Schema::dropIfExists('article_resources');
        Schema::dropIfExists('knowledge_articles');
        Schema::dropIfExists('knowledge_categories');
    }
};
