<?php

namespace App\Models;

// 3/31/2026 Edit Bayu - Model Materi (Video/Artikel) yang ada di dalam Modul
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningMaterial extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'learning_module_id', 'title', 'type',
        'content_url', 'content_body', 'order',
        'xp_reward', 'duration_minutes',
    ];

    // Relasi ke Modul induknya
    public function module()
    {
        return $this->belongsTo(LearningModule::class, 'learning_module_id');
    }

    // Relasi ke tabel progress user
    public function progresses()
    {
        return $this->hasMany(UserLearningProgress::class);
    }

    // Helper: Apakah user tertentu sudah menyelesaikan materi ini?
    public function isCompletedByUser(User $user): bool
    {
        return $this->progresses()->where('user_id', $user->id)->exists();
    }
}
