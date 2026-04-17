<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected $casts = [
        'has_pretest' => 'boolean',
        'has_quiz' => 'boolean',
        'has_posttest' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(ShortCourse::class, 'course_id');
    }

    public function quizzes()
    {
        return $this->hasMany(CourseQuiz::class, 'module_id');
    }

    public function progressions()
    {
        return $this->hasMany(ModuleProgress::class, 'module_id');
    }
}
