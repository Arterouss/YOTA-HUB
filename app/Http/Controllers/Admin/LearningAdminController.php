<?php

namespace App\Http\Controllers\Admin;

// 4/5/2026 Edit Bayu - Controller untuk Admin Learning (Evolusi menjadi Short Course Manager)
use App\Http\Controllers\Controller;
use App\Models\ShortCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LearningAdminController extends Controller
{
    public function index()
    {
        $courses = ShortCourse::latest()->get();
        return view('admin.learning.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.learning.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'course_type'  => 'required|in:free,paid',
            'organizer'    => 'required|string',
            'quota_total'  => 'required|integer|min:0',
            'price'        => 'nullable|numeric|min:0',
            'status'       => 'required|in:open,full,closed'
        ]);

        ShortCourse::create([
            'title'          => $request->title,
            'description'    => $request->description,
            'course_type'    => $request->course_type,
            'organizer'      => $request->organizer,
            'duration_start' => now(), // Default start now
            'duration_end'   => now()->addMonths(6),
            'certificate_available' => true,
            'quota_total'    => $request->quota_total,
            'quota_remaining'=> $request->quota_total,
            'price'          => $request->price ?? 0,
            'status'         => $request->status,
        ]);

        return redirect()->route('admin.learning.index')
            ->with('success', 'Program E-Learning / Short Course berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $course = ShortCourse::findOrFail($id);
        return view('admin.learning.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = ShortCourse::findOrFail($id);
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'course_type'  => 'required|in:free,paid',
            'organizer'    => 'required|string',
            'quota_total'  => 'required|integer|min:0',
            'price'        => 'nullable|numeric|min:0',
            'status'       => 'required|in:open,full,closed'
        ]);

        // Kalkulasi update sisa kuota (misal kalau kuota total ditambah)
        $diff = $request->quota_total - $course->quota_total;
        $newRemaining = max(0, $course->quota_remaining + $diff);

        $course->update([
            'title'          => $request->title,
            'description'    => $request->description,
            'course_type'    => $request->course_type,
            'organizer'      => $request->organizer,
            'quota_total'    => $request->quota_total,
            'quota_remaining'=> $newRemaining,
            'price'          => $request->price ?? 0,
            'status'         => $request->status,
        ]);

        return redirect()->route('admin.learning.index')
            ->with('success', 'Program berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $course = ShortCourse::findOrFail($id);
        $course->delete();
        return back()->with('success', 'Program berhasil dihapus beserta modul-modulnya.');
    }
}
