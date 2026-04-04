<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Seminar extends Model
{
    use HasFactory, HasUuids;

    /**
     * Mass assignable attributes untuk Layer 1 Knowledge Platform YOTA HUB.
     * Ditambahkan kolom narasumber, link meeting, pre-test, post-test, quiz, game,
     * resume, lampiran, evaluasi, dan rekaman.
     */
    protected $fillable = [
        'title',
        'slug',
        'speaker',
        'description',
        'event_date',
        'location',
        'type',
        'meeting_link',
        'pretest_link',
        'posttest_link',
        'quiz_link',
        'game_link',
        'resume_link',
        'attachment_link',
        'evaluation_link',
        'recording_link',
        'quota',
        'poster_path',
        'is_active',
    ];

    /**
     * Casting data untuk akurasi metrik kesiapan peserta.
     */
    protected $casts = [
        'event_date' => 'datetime',
        'is_active' => 'boolean',
        'quota' => 'integer',
    ];

    /**
     * Boot function untuk menangani Slug otomatis dari Title.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($seminar) {
            if (empty($seminar->slug)) {
                $seminar->slug = Str::slug($seminar->title) . '-' . Str::random(5);
            }
        });
    }

    /**
     * Scope untuk memfilter seminar yang sedang aktif (untuk tampilan publik/peserta).
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    // app/Models/Seminar.php

public function users()
{
    // Menghubungkan ke User melalui tabel pivot seminar_user
    // Kita sertakan kolom pivot agar bisa diakses untuk poin dan presensi
    return $this->belongsToMany(User::class, 'seminar_user')
                ->withPivot('is_attended', 'quiz_score', 'total_points')
                ->withTimestamps();
}

public function quizzes()
{
    return $this->hasMany(SeminarQuiz::class, 'seminar_id');
}
}
