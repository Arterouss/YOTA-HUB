<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeminarFeedback extends Model
{
    use HasFactory, HasUuids;

    /**
     * Nama tabel yang digunakan oleh model.
     */
    protected $table = 'seminar_feedback';

    /**
     * Kolom yang dapat diisi (Mass Assignable).
     */
    protected $fillable = [
        'seminar_id',
        'user_id',
        'rating',
        'message',
    ];

    /**
     * Casting tipe data agar sesuai dengan kebutuhan logic.
     */
    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Relasi: Feedback ini diberikan oleh satu User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Feedback ini ditujukan untuk satu Seminar.
     */
    public function seminar(): BelongsTo
    {
        return $this->belongsTo(Seminar::class, 'seminar_id');
    }
}
