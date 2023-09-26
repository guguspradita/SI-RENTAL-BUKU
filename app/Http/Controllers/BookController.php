<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // dd('Ini halaman books');
        // $request->session()->flush();
        return view('BackEnd.books');
    }
}
