<?php

namespace App\Http\Controllers\MemberBasic\Bayu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BayuModuleController extends Controller
{
    /**
     * Menampilkan halaman index Module Bayu.
     * Dibuat: 2026-03-12
     */
    public function index()
    {
        return view('member_basic.bayu.index'); //membuat view ini selanjutnya
    }
}
