<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $totalUsers = \App\Models\User::count();
        $activeProjects = \App\Models\Seminar::where('is_active', true)->count() + \App\Models\ShortCourse::where('status', 'published')->count();
        $users = \App\Models\User::with('roles')->paginate(10);

        // Sebagai CEO & Founder, workspace ini adalah pusat kendali Anda
        return view('admin.superadmin.index', compact('totalUsers', 'activeProjects', 'users'));
    }
}
