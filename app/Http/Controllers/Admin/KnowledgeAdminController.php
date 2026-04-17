<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KnowledgeArticle;
use App\Models\KnowledgeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class KnowledgeAdminController extends Controller
{
    public function index()
    {
        $articles = KnowledgeArticle::with('category')->latest()->get();
        return view('admin.knowledge.index', compact('articles'));
    }

    public function create()
    {
        $categories = KnowledgeCategory::all();
        // Fallback jika belum ada kategori
        if ($categories->isEmpty()) {
            KnowledgeCategory::insert([
                ['id' => Str::uuid(), 'category_name' => 'Mitigasi', 'category_slug' => 'mitigasi'],
                ['id' => Str::uuid(), 'category_name' => 'Teknologi', 'category_slug' => 'teknologi'],
                ['id' => Str::uuid(), 'category_name' => 'Pendidik', 'category_slug' => 'pendidik']
            ]);
            $categories = KnowledgeCategory::all();
        }
        return view('admin.knowledge.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'category_id'    => 'required|uuid',
            'summary'        => 'required|string',
            'content'        => 'required|string',
            'featured_image' => 'nullable|url',
            'reading_time'   => 'required|integer|min:1',
            'status'         => 'required|in:draft,published',
        ]);

        KnowledgeArticle::create([
            'id'             => Str::uuid(),
            'title'          => $request->title,
            'slug'           => Str::slug($request->title) . '-' . Str::random(5),
            'author_id'      => Auth::id(),
            'category_id'    => $request->category_id,
            'content'        => $request->content,
            'summary'        => $request->summary,
            'featured_image' => $request->featured_image,
            'status'         => $request->status,
            'publish_date'   => $request->status == 'published' ? now() : null,
            'reading_time'   => $request->reading_time,
            'view_count'     => 0
        ]);

        return redirect()->route('admin.knowledge.index')->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit($id)
    {
        $article = KnowledgeArticle::findOrFail($id);
        $categories = KnowledgeCategory::all();
        return view('admin.knowledge.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $article = KnowledgeArticle::findOrFail($id);
        
        $request->validate([
            'title'          => 'required|string|max:255',
            'category_id'    => 'required|uuid',
            'summary'        => 'required|string',
            'content'        => 'required|string',
            'featured_image' => 'nullable|url',
            'reading_time'   => 'required|integer|min:1',
            'status'         => 'required|in:draft,published',
        ]);

        $article->update([
            'title'          => $request->title,
            'category_id'    => $request->category_id,
            'content'        => $request->content,
            'summary'        => $request->summary,
            'featured_image' => $request->featured_image,
            'status'         => $request->status,
            'publish_date'   => ($request->status == 'published' && !$article->publish_date) ? now() : $article->publish_date,
            'reading_time'   => $request->reading_time,
        ]);

        return redirect()->route('admin.knowledge.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $article = KnowledgeArticle::findOrFail($id);
        $article->delete();
        return back()->with('success', 'Artikel berhasil dihapus.');
    }
}
