<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortCourse extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    protected $casts = [
        'duration_start' => 'date',
        'duration_end' => 'date',
        'certificate_available' => 'boolean',
    ];

    public function modules()
    {
        return $this->hasMany(CourseModule::class, 'course_id')->orderBy('module_order');
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class, 'course_id');
    }

    public function tasks()
    {
        return $this->hasMany(CourseTask::class, 'course_id');
    }
}
