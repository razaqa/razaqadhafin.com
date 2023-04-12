<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
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
        $messages = Message::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $comment)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }

        $comment->delete();
        flash()->overlay('Comment deleted successfully.');

        return redirect('/admin/messages');
    }
}
