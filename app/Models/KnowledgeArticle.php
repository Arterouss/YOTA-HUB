<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeArticle extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected $casts = [
        'publish_date' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(KnowledgeCategory::class, 'category_id');
    }

    public function resources()
    {
        return $this->hasMany(ArticleResource::class, 'article_id');
    }

    public function comments()
    {
        return $this->hasMany(ArticleComment::class, 'article_id')->whereNull('parent_comment_id')->orderBy('created_at', 'desc');
    }
    
    public function allComments()
    {
        return $this->hasMany(ArticleComment::class, 'article_id');
    }

    public function reads()
    {
        return $this->hasMany(ArticleRead::class, 'article_id');
    }
}
