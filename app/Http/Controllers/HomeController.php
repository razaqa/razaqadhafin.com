<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        $posts      = Post::count();
        $comments   = Comment::count();
        $tags       = Tag::count();
        $categories = Category::count();

        return view('home', get_defined_vars());
    }
}
