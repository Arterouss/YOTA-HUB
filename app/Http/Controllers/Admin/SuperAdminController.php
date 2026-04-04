<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        // Sebagai CEO & Founder, workspace ini adalah pusat kendali Anda
        return view('admin.superadmin.index');
    }
}
