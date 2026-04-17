<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTask extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function course()
    {
        return $this->belongsTo(ShortCourse::class, 'course_id');
    }

    public function submissions()
    {
        return $this->hasMany(TaskSubmission::class, 'task_id');
    }
}
