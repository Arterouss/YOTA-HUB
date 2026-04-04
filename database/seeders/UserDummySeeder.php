<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserDummySeeder extends Seeder
{
    public function run(): void
    {
        // Data akun demo untuk setiap role
        $users = [
            [
                'name' => 'Master Admin YOTA',
                'email' => 'admin@yotahub.id',
                'role' => 'super_admin',
                'level' => 4,
                'type' => 'verified'
            ],
            [
                'name' => 'Admin Learning Layer 1',
                'email' => 'admin.l1@yotahub.id',
                'role' => 'admin_layer1',
                'level' => 1,
                'type' => 'verified'
            ],
            [
                'name' => 'Mentor Inovasi YOTA',
                'email' => 'mentor@yotahub.id',
                'role' => 'mentor',
                'level' => 3,
                'type' => 'verified'
            ],
            [
                'name' => 'Mitra Strategis PT YIN',
                'email' => 'mitra@yotahub.id',
                'role' => 'mitra',
                'level' => 1,
                'type' => 'verified'
            ],
            [
                'name' => 'Narasumber Eksklusif',
                'email' => 'narasumber@yotahub.id',
                'role' => 'narasumber',
                'level' => 1,
                'type' => 'verified'
            ],
            [
                'name' => 'Ahli Riset & Pakar',
                'email' => 'ahli@yotahub.id',
                'role' => 'ahli_pakar',
                'level' => 3,
                'type' => 'verified'
            ],
            [
                'name' => 'Verified Innovator',
                'email' => 'verified@yotahub.id',
                'role' => 'verified_member',
                'level' => 2,
                'type' => 'verified'
            ],
            [
                'name' => 'Basic Member Testing',
                'email' => 'user@yotahub.id',
                'role' => 'basic_member',
                'level' => 1,
                'type' => 'basic'
            ],
        ];

        foreach ($users as $userData) {
            // updateOrCreate: Jika email ada, update datanya. Jika tidak ada, buat baru.
            $user = User::updateOrCreate(
                ['email' => $userData['email']], // Kunci pencarian
                [
                    'id' => (string) Str::uuid(),
                    'name' => $userData['name'],
                    'password' => bcrypt('password123'),
                    'level' => $userData['level'],
                    'member_type' => $userData['type'],
                    'agreed_to_terms' => true,
                    'terms_agreed_at' => Carbon::now(),
                    'email_verified_at' => Carbon::now(),
                    'registration_ip' => '127.0.0.1',
                ]
            );

            // Sinkronisasi role agar user hanya punya 1 role spesifik
            $user->syncRoles([$userData['role']]);
        }
    }
}
