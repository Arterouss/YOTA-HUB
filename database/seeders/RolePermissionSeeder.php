<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache roles dan permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Definisikan Permission - Gunakan firstOrCreate agar tidak error jika dijalankan ulang
        $permissions = [
            'access layer 1', 'access layer 2', 'access layer 3', 'access layer 4',
            'manage users', 'manage programs', 'verify experiments', 'publish articles'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Buat Role (firstOrCreate)
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $roleAdminLayer1 = Role::firstOrCreate(['name' => 'admin_layer1']);
        $roleMentor = Role::firstOrCreate(['name' => 'mentor']);
        $roleVerifiedMember = Role::firstOrCreate(['name' => 'verified_member']);
        $roleBasicMember = Role::firstOrCreate(['name' => 'basic_member']);

        // 3 Role Baru Sesuai Request
        $roleMitra = Role::firstOrCreate(['name' => 'mitra']);
        $roleNarasumber = Role::firstOrCreate(['name' => 'narasumber']);
        $roleAhli = Role::firstOrCreate(['name' => 'ahli_pakar']);

        // 3. Sinkronisasi Permission ke Role
        // Super Admin dapat segalanya
        $roleSuperAdmin->syncPermissions(Permission::all());

        // Ahli/Pakar: Akses Layer 3 & Verifikasi
        $roleAhli->syncPermissions(['access layer 3', 'verify experiments']);

        // Narasumber: Publikasi Artikel
        $roleNarasumber->syncPermissions(['publish articles']);

        // Basic & Verified Member
        $roleBasicMember->syncPermissions(['access layer 1']);
        $roleVerifiedMember->syncPermissions(['access layer 1', 'access layer 2']);
    }
}
