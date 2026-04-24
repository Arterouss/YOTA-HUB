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
        // Ambil seminar yang diikuti user untuk ditampilkan di dashboard
        $joinedSeminars = $user->seminars()->take(5)->get();

        // 3. Data Logic untuk Short Course
        $enrolledCourses = \App\Models\CourseEnrollment::with('course')
            ->where('user_id', $user->id)
            ->get();
        $completedCoursesCount = $enrolledCourses->where('status', 'completed')->count();

        // 4. Data Logic untuk Knowledge Hub
        $totalArticlesRead = \App\Models\ArticleRead::where('user_id', $user->id)->count();
        $totalLiteracyPoints = \App\Models\ArticleRead::where('user_id', $user->id)->sum('point_earned');
        
        // Cari topik favorit (kategori yang paling sering dibaca)
        $favoriteCategory = \App\Models\ArticleRead::select('knowledge_categories.category_name')
            ->join('knowledge_articles', 'article_reads.article_id', '=', 'knowledge_articles.id')
            ->join('knowledge_categories', 'knowledge_articles.category_id', '=', 'knowledge_categories.id')
            ->where('article_reads.user_id', $user->id)
            ->groupBy('knowledge_categories.id', 'knowledge_categories.category_name')
            ->orderByRaw('COUNT(article_reads.id) DESC')
            ->value('category_name') ?? 'Belum ada';

        $data = [
            'user' => $user,
            'joinedSeminars' => $joinedSeminars,
            'enrolledCourses' => $enrolledCourses,
            'layerInfo' => [
                'current_level' => $user->level, // Berasal dari kolom level di DB
                'is_verified' => ($user->member_type === 'verified'), // Cek tipe member
            ],
            'stats' => [
                'courses_completed' => $completedCoursesCount,
                'innovation_points' => $user->seminars()->sum('seminar_user.point_earned') + $totalLiteracyPoints,
                'articles_read' => $totalArticlesRead,
                'literacy_points' => $totalLiteracyPoints,
                'favorite_topic' => $favoriteCategory,
            ]
        ];

        return view('dashboard', $data);
    }
}
