<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
            if (Auth::user()->status != 'active') {
                // Jika user status tidak active maka hapus session(logout) 
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

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

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function registerProses(Request $request)
    {

        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'phone' => 'nullable|numeric|max:16',
            'address' => 'required'
        ]);

        // Enkripsi Password menggunakan hash (bycrpt)
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());

        return redirect('/register')->with('status', 'Register success. Waiting admin for approval!');
    }
}