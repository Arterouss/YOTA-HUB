<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 3/31/2026 Edit Bayu - Membuat Model SeminarQuiz baru untuk mengatasi error "Class App\Models\SeminarQuiz not found" saat login dan memuat dashboard karena relasi quizzes() dipanggil pada halaman detail seminar.
class SeminarQuiz extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'seminar_quizzes';

    protected $fillable = [
        'seminar_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'points'
    ];

    public function seminar()
    {
        return $this->belongsTo(Seminar::class, 'seminar_id');
    }
}
