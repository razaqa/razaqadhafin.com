<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function homepage(Request $request)
    {
        $posts = Post::when($request->search, function($query) use($request) {
                        $search = $request->search;

                        return $query->where('title', 'like', "%$search%")
                            ->orWhere('body', 'like', "%$search%");
                    })->with('tags', 'category', 'user', 'comments', 'likes')
                    ->withCount('comments')
                    ->withCount('likes')
                    ->where('is_published', true)
                    ->orderBy('created_at', 'desc')
                    ->get();

        $tags = Tag::where('for_work', false)->get();
        $work_tags = Tag::where('for_work', true)->get();

        $work_posts = Category::where('name', 'Works')->with('posts')->first();
        $url = $request->url();

        return view('pages.homepage', get_defined_vars());
    }

    public function message(Request $request)
    {
        $this->validate($request, ['body' => 'required', 'name' => 'required']);

        if (Auth::user() == null) {
            Message::create([
                'body' => $request->body,
                'name' => $request->name . ' (Anonymous)'
            ]);
        } else {
            Auth::user()->messages()->create([
                'body' => $request->body,
                'name' => Auth::user()->name
            ]);
        }

        return redirect()->route('homepage');
    }

    public function comment(Request $request, Post $post)
    {
        $this->validate($request, ['body' => 'required']);

        $post->comments()->create([
            'body' => $request->body
        ]);
        flash()->overlay('Comment submitted successfully.');

        return redirect()->route('article', ['article_id' => $post->id]);

    }

    public function like(Request $request, Post $post)
    {
        $post->likes()->create();
        flash()->overlay('Like submitted successfully.');
        
        return redirect()->route('article', ['article_id' => $post->id]);

    }

    public function article(Request $request, $article_id)
    {
        $post = Post::find($article_id);
        if ($post->is_published == false) {
            return redirect('/article-not-found');
        }

        $url = $request->url();

        return view('pages.article', get_defined_vars());
    }

    public function category(Request $request, $tag_name)
    {
        $posts = Post::whereHas('tags', function($q) use($tag_name) {
                    $q->where('name', $tag_name);
                })
                ->where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->get();

        $url = $request->url();

        return view('pages.category', get_defined_vars());
    }
}
