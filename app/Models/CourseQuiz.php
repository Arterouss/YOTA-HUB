<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseQuiz extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function module()
    {
        return $this->belongsTo(CourseModule::class, 'module_id');
    }
}
