<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function course()
    {
        return $this->belongsTo(ShortCourse::class, 'course_id');
    }

    public function progressions()
    {
        return $this->hasMany(ModuleProgress::class, 'module_id');
    }
}
