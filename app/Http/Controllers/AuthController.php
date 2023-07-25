<?php

namespace App\Http\Controllers;

use session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('FrontEnd.login');
    }

    public function register(Request $request)
    {
        return view('FrontEnd.register');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // cek apakah user status = active
            if (Auth::user()->status != 'active'){
                $request->session()->flash('status', 'Your account is not active yet. please contact admin!');
                return redirect('/login');
            }

            $request->session()->regenerate();
            
            if (Auth::user()->role_id == 1) {
                return redirect('/dashboard');
            }
            if (Auth::user()->role_id == 2) {
                return redirect('/profile');
            }

            // return redirect()->intended('/dashboard');
        }
        $request->session()->flash('status', 'Login Invalid !');
        return redirect('/login');
    }
}