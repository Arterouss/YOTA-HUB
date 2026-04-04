<?php

namespace App\Models;

// 3/31/2026 Edit Bayu - Model untuk menyimpan Competency Score / progress tiap peserta per materi
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLearningProgress extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'user_learning_progress';

    protected $fillable = [
        'user_id', 'learning_material_id', 'xp_earned', 'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function material()
    {
        return $this->belongsTo(LearningMaterial::class, 'learning_material_id');
    }
}
