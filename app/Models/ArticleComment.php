<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(KnowledgeArticle::class, 'article_id');
    }

    public function replies()
    {
        return $this->hasMany(ArticleComment::class, 'parent_comment_id')->orderBy('created_at', 'asc');
    }

    public function parent()
    {
        return $this->belongsTo(ArticleComment::class, 'parent_comment_id');
    }

    public function likes()
    {
        return $this->hasMany(CommentLike::class, 'comment_id');
    }
}
