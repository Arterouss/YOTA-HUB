<?php

namespace App\Http\Controllers\Admin;

// 4/5/2026 Edit Bayu - Controller untuk Admin Learning mengelola modul E-Learning
use App\Http\Controllers\Controller;
use App\Models\Seminar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LearningAdminController extends Controller
{
    public function index()
    {
        $modules = Seminar::where('type', 'E-Learning')->latest()->get();
        return view('admin.learning.index', compact('modules'));
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
            'grading_type' => 'required|in:auto,manual',
            'quota'        => 'required|integer|min:0',
            'recording_link' => 'nullable|url',
            'attachment_link' => 'nullable|url',
            'quiz_link'    => 'nullable|url',
        ]);

        Seminar::create([
            'id'             => (string) Str::uuid(),
            'title'          => $request->title,
            'slug'           => Str::slug($request->title) . '-' . Str::random(5),
            'description'    => $request->description,
            'type'           => 'E-Learning',
            'grading_type'   => $request->grading_type,
            'recording_link' => $request->recording_link,
            'attachment_link'=> $request->attachment_link,
            'quiz_link'      => $request->quiz_link,
            'event_date'     => now(),
            'location'       => 'Online',
            'quota'          => $request->quota,
            'is_active'      => true,
        ]);

        return redirect()->route('admin.learning.index')
            ->with('success', 'Modul E-Learning berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $module = Seminar::where('type', 'E-Learning')->findOrFail($id);
        return view('admin.learning.edit', compact('module'));
    }

    public function update(Request $request, $id)
    {
        $module = Seminar::where('type', 'E-Learning')->findOrFail($id);
        $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'grading_type' => 'required|in:auto,manual',
            'quota'        => 'required|integer|min:0',
            'recording_link' => 'nullable|url',
            'attachment_link' => 'nullable|url',
        ]);

        $module->update([
            'title'          => $request->title,
            'description'    => $request->description,
            'grading_type'   => $request->grading_type,
            'recording_link' => $request->recording_link,
            'attachment_link'=> $request->attachment_link,
            'quiz_link'      => $request->quiz_link,
            'quota'          => $request->quota,
            'is_active'      => $request->has('is_active'),
        ]);

        return redirect()->route('admin.learning.index')
            ->with('success', 'Modul berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $module = Seminar::where('type', 'E-Learning')->findOrFail($id);
        $module->delete();
        return back()->with('success', 'Modul berhasil dihapus.');
    }
}
