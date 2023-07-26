<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // $request->session()->flush();
        return view('FrontEnd.books');
    }
}
