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
        $user = User::where('role_id', 2)->get();
        return view('BackEnd.users.user', ['users' => $user]);
    }

    public function registeredUser()
    {
        return view('BackEnd.users.registered-user');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:255',
            'password' => 'required|max:255',
            'phone' => 'required|max:12',
            'address' => 'required|max:255',
        ]);
        dd($request->all());
    }
}
