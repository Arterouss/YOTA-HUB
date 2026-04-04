<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids, SoftDeletes, HasRoles;
// Tambahkan ini agar Eloquent tidak bingung saat proses Insert
    public $incrementing = false;
    protected $keyType = 'string';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'uuid', // Tambahkan ini jika masih ada kolom uuid terpisah di migration Anda
        'name',
        'email',
        'email_verified_at', // 3/31/2026 Edit Bayu - Tambahkan agar dapat diisi saat Google Login
        'password',
        'level',                // Layer 1-4
        'member_type',          // basic / verified
        'agreed_to_terms',      // Compliance Hukum
        'terms_agreed_at',      // Audit Trail
        'registration_ip',      // Security Tracking
        'encrypted_phone',
        'google_id', 'google_token', 'google_refresh_token'      // Data Terenkripsi
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'registration_ip', // Sembunyikan data sensitif dari API
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'terms_agreed_at' => 'datetime',
            'agreed_to_terms' => 'boolean',
            'level' => 'integer',

            // AUTOMATIC ENCRYPTION
            // Laravel akan mengenkripsi data ini saat disimpan ke DB
            // dan mendekripsinya saat dipanggil di aplikasi.
            'encrypted_phone' => 'encrypted',
        ];
    }

    /**
     * Helper untuk cek apakah user sudah di Layer tertentu
     */
    public function isAtLeastLevel(int $requiredLevel): bool
    {
        return $this->level >= $requiredLevel;
    }

    /**
     * Helper untuk cek status verifikasi
     */
    public function isVerified(): bool
    {
        return $this->member_type === 'verified';
    }

    protected static function boot()
{
    parent::boot();

    // Otomatis isi kolom uuid sebelum data dibuat (creating)
    static::creating(function ($model) {
        if (empty($model->uuid)) {
            $model->uuid = (string) \Illuminate\Support\Str::uuid();
        }
    });
}


// Di dalam file App\Models\Seminar.php
public function users()
{
    return $this->belongsToMany(User::class)->withPivot('is_attended', 'quiz_score', 'total_points');
}




}
