<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShortCourse;
use App\Models\CourseModule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LearningModuleAdminController extends Controller
{
    public function index($course_id)
    {
        $course = ShortCourse::findOrFail($course_id);
        $modules = CourseModule::where('course_id', $course_id)->orderBy('module_order', 'asc')->get();
        return view('admin.learning.modules.index', compact('course', 'modules'));
    }

    public function create($course_id)
    {
        $course = ShortCourse::findOrFail($course_id);
        $lastOrder = CourseModule::where('course_id', $course_id)->max('module_order') ?? 0;
        $nextOrder = $lastOrder + 1;
        return view('admin.learning.modules.create', compact('course', 'nextOrder'));
    }

    public function store(Request $request, $course_id)
    {
        $course = ShortCourse::findOrFail($course_id);
        
        $request->validate([
            'title'       => 'required|string|max:255',
            'video_url'   => 'nullable|url',
            'content'     => 'nullable|string',
            'order_index' => 'required|integer',
        ]);

        CourseModule::create([
            'course_id'       => $course->id,
            'module_title'    => $request->title,
            'text_content'    => $request->content,
            'video_url'       => $request->video_url,
            'module_order'    => $request->order_index,
            'content_type'    => $request->video_url ? 'video' : 'text',
        ]);

        return redirect()->route('admin.learning.modules.index', $course->id)
            ->with('success', 'Sub-modul berhasil ditambahkan!');
    }

    public function edit($course_id, $module_id)
    {
        $course = ShortCourse::findOrFail($course_id);
        $module = CourseModule::where('course_id', $course_id)->findOrFail($module_id);
        return view('admin.learning.modules.edit', compact('course', 'module'));
    }

    public function update(Request $request, $course_id, $module_id)
    {
        $module = CourseModule::where('course_id', $course_id)->findOrFail($module_id);
        
        $request->validate([
            'title'       => 'required|string|max:255',
            'video_url'   => 'nullable|url',
            'content'     => 'nullable|string',
            'order_index' => 'required|integer',
        ]);

        $module->update([
            'module_title'    => $request->title,
            'text_content'    => $request->content,
            'video_url'       => $request->video_url,
            'module_order'    => $request->order_index,
            'content_type'    => $request->video_url ? 'video' : 'text',
        ]);

        return redirect()->route('admin.learning.modules.index', $course_id)
            ->with('success', 'Sub-modul berhasil diperbarui!');
    }

    public function destroy($course_id, $module_id)
    {
        $module = CourseModule::where('course_id', $course_id)->findOrFail($module_id);
        $module->delete();
        return back()->with('success', 'Sub-modul berhasil dihapus.');
    }
}
