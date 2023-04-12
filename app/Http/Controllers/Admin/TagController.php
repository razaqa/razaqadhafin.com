<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
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
        $tags = Tag::paginate(10);

        return view('admin.tags.index', compact('tags'));
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
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        $this->validate($request, ['name' => 'required']);

        Tag::create(['name' => $request->name]);
        flash()->overlay('Tag created successfully.');

        return redirect('/admin/tags');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        $this->validate($request, ['name' => 'required']);

        $tag->update($request->all());
        flash()->overlay('Tag updated successfully.');

        return redirect('/admin/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        $tag->delete();
        flash()->overlay('Tag deleted successfully.');

        return redirect('/admin/tags');
    }

    public function setForWork(Tag $tag)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }

        $tag->for_work = true;
        $tag->save();
        flash()->overlay('Tag changed successfully.');

        return redirect('/admin/tags');
    }

    public function unsetForWork(Tag $tag)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }

        $tag->for_work = false;
        $tag->save();
        flash()->overlay('Tag changed successfully.');

        return redirect('/admin/tags');
    }
}
