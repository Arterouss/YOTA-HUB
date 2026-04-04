<?php

namespace App\Models;

// 3/31/2026 Edit Bayu - Model baru untuk fitur E-Learning Modul Layer 1
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningModule extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title', 'slug', 'description', 'thumbnail',
        'category', 'order', 'status', 'total_xp',
    ];

    // Relasi: Satu Modul punya banyak Materi
    public function materials()
    {
        return $this->hasMany(LearningMaterial::class)->orderBy('order');
    }

    // Scope: Hanya ambil modul yang dipublikasikan
    public function scopePublished($query)
    {
        return $query->where('status', 'published')->orderBy('order');
    }

    // Helper: Hitung total progress seorang user di modul ini (dalam %)
    public function progressForUser(User $user): int
    {
        $total = $this->materials()->count();
        if ($total === 0) return 0;

        $completed = UserLearningProgress::whereIn('learning_material_id', $this->materials()->pluck('id'))
            ->where('user_id', $user->id)
            ->count();

        return (int) round(($completed / $total) * 100);
    }
}
