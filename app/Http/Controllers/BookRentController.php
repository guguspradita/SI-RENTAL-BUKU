<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
        $request['rent_date'] = Carbon::now()->toDateTimeString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateTimeString();

        $book = Book::findOrFail($request->book_id)->only('status'); // hanya mengambil status dari book
        // dd($book);
        if ($book['status'] != 'in stock') {
            Session::flash('message', 'Cannot Rent, the book is not available!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book-rent');
        } else {
            try {
                DB::beginTransaction();
                // process insert to rent_logs table
                RentLogs::create($request->all());
                // process update book table
                $book = Book::findOrFail($request->book_id);
                $book->status = 'not available';
                $book->save();
                DB::commit();

                Session::flash('message', 'Rent book success!!!');
                Session::flash('alert-class', 'alert-success');
                return redirect('book-rent');
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }
    }
}
