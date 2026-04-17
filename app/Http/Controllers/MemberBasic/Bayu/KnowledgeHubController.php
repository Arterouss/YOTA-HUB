<?php

namespace App\Http\Controllers\MemberBasic\Bayu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KnowledgeArticle;
use App\Models\KnowledgeCategory;
use App\Models\ArticleComment;
use App\Models\CommentLike;
use App\Models\ArticleRead;
use Illuminate\Support\Facades\Auth;

class KnowledgeHubController extends Controller
{
    public function index(Request $request)
    {
        $query = KnowledgeArticle::with(['category', 'author'])
            ->where('status', 'published');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('category_slug', $request->category);
            });
        }

        $articles = $query->orderBy('publish_date', 'desc')->paginate(12);
        
        $categories = KnowledgeCategory::all();
        
        // Popular: based on view count and likes?
        $popularArticles = KnowledgeArticle::where('status', 'published')
            ->orderBy('view_count', 'desc')
            ->take(5)->get();

        $user = Auth::user();
        $totalRead = ArticleRead::where('user_id', $user->id)->count();
        $totalPoints = ArticleRead::where('user_id', $user->id)->sum('point_earned');

        return view('member_basic.bayu.knowledge.index', compact('articles', 'categories', 'popularArticles', 'totalRead', 'totalPoints'));
    }

    public function show($slug)
    {
        $article = KnowledgeArticle::with(['author', 'category', 'resources'])
                    ->where('slug', $slug)
                    ->where('status', 'published')
                    ->firstOrFail();

        // Increment view count via eloquent
        $article->increment('view_count');

        // Recommended articles based on category
        $recommended = KnowledgeArticle::where('category_id', $article->category_id)
                        ->where('id', '!=', $article->id)
                        ->where('status', 'published')
                        ->take(3)->get();

        // Load nested comments explicitly since `comments()` only gets root comments
        $comments = $article->comments()->with(['user', 'likes', 'replies.user'])->get();

        $user = Auth::user();
        $hasRead = ArticleRead::where('user_id', $user->id)->where('article_id', $article->id)->exists();

        return view('member_basic.bayu.knowledge.show', compact('article', 'comments', 'recommended', 'hasRead'));
    }

    public function claimReadingPoint(Request $request, $article_id)
    {
        $user = Auth::user();
        $article = KnowledgeArticle::findOrFail($article_id);

        $readDuration = $request->input('duration', 0); // e.g from JS timer

        if ($readDuration < 30) {
            return response()->json(['success' => false, 'message' => 'Durasi baca kurang dari batas minimal.']);
        }

        $alreadyClaimed = ArticleRead::where('user_id', $user->id)->where('article_id', $article->id)->exists();
        
        if ($alreadyClaimed) {
            return response()->json(['success' => true, 'message' => 'Points already claimed', 'points' => 0]);
        }

        ArticleRead::create([
            'user_id' => $user->id,
            'article_id' => $article->id,
            'read_duration' => $readDuration,
            'point_earned' => 5
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Berhasil klaim +5 Poin Gamifikasi!',
            'points' => 5
        ]);
    }

    public function postComment(Request $request, $article_id)
    {
        $request->validate([
            'comment_content' => 'required|string|max:1000'
        ]);

        $article = KnowledgeArticle::findOrFail($article_id);
        
        ArticleComment::create([
            'user_id' => Auth::id(),
            'article_id' => $article->id,
            'comment_content' => $request->comment_content,
            'parent_comment_id' => $request->parent_comment_id ?? null
        ]);

        return back()->with('success', 'Komentar Anda berhasil ditambahkan!');
    }

    public function toggleLikeComment(Request $request, $comment_id)
    {
        $user = Auth::user();
        $comment = ArticleComment::findOrFail($comment_id);

        $like = CommentLike::where('user_id', $user->id)->where('comment_id', $comment->id)->first();

        if ($like) {
            $like->delete();
            return response()->json(['status' => 'unliked']);
        } else {
            CommentLike::create([
                'user_id' => $user->id,
                'comment_id' => $comment->id
            ]);
            return response()->json(['status' => 'liked']);
        }
    }
}
