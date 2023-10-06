<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        // $request->session()->flush();
        return view('BackEnd.profile');
    }

    public function index()
    {
        $user = User::where('role_id', 2)->where('status', 'active')->get();
        return view('BackEnd.users.user', ['users' => $user]);
    }

    public function registeredUser()
    {
        $registeredUsers = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('BackEnd.users.registered-user', ['registedUsers' => $registeredUsers]);
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('BackEnd.users.user-detail', ['user' => $user]);
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        return redirect('/user-detail/' . $slug)->with(['success' => 'User Approved Successfully!']);
    }

    public function delete($slug)
    {
        $user = USer::where('slug', $slug)->first();
        $user->delete();

        return redirect('/users')->with(['success' => 'User Deleted Successfully!']);
    }

    public function deleteUser()
    {
        $user = User::onlyTrashed()->get();
        return view('BackEnd.users.user-delete', ['deleteUser' => $user]);
    }

    public function restore($slug)
    {
        $users = User::withTrashed()->where('slug', $slug)->restore();
        return redirect('/users')->with(['success' => 'User Restore Successfully!']);
    }
}
