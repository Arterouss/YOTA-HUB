<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the dashboard landing page based on User Roles.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Redirection Logics untuk Role Administratif
        if ($user->hasRole('super_admin')) {
            return redirect()->route('admin.super.index');
        }

        // 4/5/2026 Edit Bayu - Admin Layer 1 langsung diarahkan ke halaman Admin E-Learning
        if ($user->hasRole('admin_layer1')) {
            return redirect()->route('admin.learning.index');
        }

        if ($user->hasPermissionTo('manage programs')) {
            return redirect()->route('admin.programs.index');
        }

        // 4/5/2026 Edit Bayu - Bypass redirect Narasumber karena fitur Publication belum jadi
        // if ($user->hasPermissionTo('publish articles')) {
        //     return redirect()->route('admin.publications.index');
        // }

        // 2. Data Logic untuk User Biasa (Layer 1 - 4)
        // Kita kirimkan status layer untuk kontrol UI di Blade
        $data = [
            'user' => $user,
            'layerInfo' => [
                'current_level' => $user->level, // Berasal dari kolom level di DB
                'is_verified' => ($user->member_type === 'verified'), // Cek tipe member
            ],
            'stats' => [
                'courses_completed' => 0, // Placeholder untuk fitur selanjutnya
                'innovation_points' => 0,
            ]
        ];

        return view('dashboard', $data);
    }
}
