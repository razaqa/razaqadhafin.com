<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
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
        $users = User::withCount('posts')->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->is_admin == false) {
            return redirect('/');
        }
        if(auth()->user() == $user) {
            flash()->overlay("You can't delete yourself.");

            return redirect('/admin/users');
        }

        $user->delete();
        flash()->overlay('User deleted successfully.');

        return redirect('/admin/users');
    }
}
