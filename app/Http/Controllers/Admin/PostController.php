<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebHelper;

class PostController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        $posts = Post::with(['user', 'category', 'tags', 'comments'])->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        $categories = Category::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'name')->all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        if (!$request->has('pict')) {
            return redirect('/warning/' . urlencode('Harus masukkan gambar cover postingan'));
        }
        $image = WebHelper::saveImageToPublic($request->file('pict'), '/img/post');

        $post = Post::create([
            'title'       => $request->title,
            'created_at'  => $request->created_at,
            'body'        => $request->body,
            'category_id' => $request->category_id,
            'pict'        => $image
        ]);

        $tagsId = collect($request->tags)->map(function($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        });

        $post->tags()->attach($tagsId);
        flash()->overlay('Post created successfully.');

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        $post = $post->load(['user', 'category', 'tags', 'comments']);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        if($post->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash()->overlay("You can't edit other peoples post.");
            return redirect('/admin/posts');
        }

        $categories = Category::pluck('name', 'id')->all();
        $tags = Tag::pluck('name', 'name')->all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        if ($request->has('pict')) {
            $image = WebHelper::saveImageToPublic($request->file('pict'), '/img/post');
            $post->update([
                'title'       => $request->title,
                'created_at'  => $request->created_at,
                'body'        => $request->body,
                'category_id' => $request->category_id,
                'pict'        => $image
            ]);
        } else {
            $post->update([
                'title'       => $request->title,
                'created_at'  => $request->created_at,
                'body'        => $request->body,
                'category_id' => $request->category_id
            ]);
        }

        $tagsId = collect($request->tags)->map(function($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        });

        $post->tags()->sync($tagsId);
        flash()->overlay('Post updated successfully.');

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        if($post->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash()->overlay("You can't delete other peoples post.");
            return redirect('/admin/posts');
        }

        $post->delete();
        flash()->overlay('Post deleted successfully.');

        return redirect('/admin/posts');
    }

    public function publish(Post $post)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        $post->is_published = !$post->is_published;
        $post->save();
        flash()->overlay('Post changed successfully.');

        return redirect('/admin/posts');
    }

    public function setHeadline(Post $post)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        Post::where('category_id', $post->category_id)->update([
            'is_headline' => false
        ]);

        $post->is_headline = true;
        $post->save();
        flash()->overlay('Post changed successfully.');

        return redirect('/admin/posts');
    }

    public function setHomepageHeadline(Post $post)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        Post::where('is_top_headline', true)->update([
            'is_top_headline' => false
        ]);

        $post->is_top_headline = true;
        $post->save();
        flash()->overlay('Post changed successfully.');

        return redirect('/admin/posts');
    }
}
