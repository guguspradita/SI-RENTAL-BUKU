<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index()
    {
        $rentlogs = RentLogs::with(['user', 'book'])->get();
        // dd($rentlogs);
        return view('BackEnd.rent_log', ['rentlogs' => $rentlogs]);
    }
}
