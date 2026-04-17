<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KnowledgeCategory extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function articles()
    {
        return $this->hasMany(KnowledgeArticle::class, 'category_id');
    }
}
