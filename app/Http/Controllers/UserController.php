<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        dd('Ini halaman profile client');
        // dd(Auth::user());
        $request->session()->flush();
        return view('BackEnd.profile');
    }
}
