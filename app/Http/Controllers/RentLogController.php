<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index()
    {
        return view('BackEnd.rent_log');
    }
}
