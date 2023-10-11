<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->get(); // get() -> lebih dari satu data
        $books = Book::all();
        return view('BackEnd.book-rent', ['users' => $users, 'books' => $books]);
    }

    public function store(Request $request)
    {
        $request['rent_date'] = Carbon::now()->isoFormat('dddd, D MMMM Y');
        dd($request->all());
    }
}
