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
        $users = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get(); // get() -> lebih dari satu data
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
            // get user_id yang actual_return_datenya null
            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

            // cek kondisi user_id yang actual_return_datenya null
            if ($count >= 3) {
                Session::flash('message', 'Cannot Rent, User has reach limit of books!');
                Session::flash('alert-class', 'alert-danger');
                return redirect('book-rent');
            }
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

    public function returnBook()
    {
        $users = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get(); // get() -> lebih dari satu data
        $books = Book::all();
        return view('BackEnd.book-return', ['users' => $users, 'books' => $books]);
    }

    public function saveReturnBook(Request $request)
    {
        // user & buku yang dipilih untuk direturn benar, maka berhasil return book
        // user & buku yang dipilih untuk direturn salah, maka muncul error notice
        $rent = RentLogs::where('user_id', $request->user_id)->where('book_id', $request->book_id)->where('actual_return_date', null);
        $rentData = $rent->first();
        $countData =  $rent->count();

        if ($countData == 1) {
            try {
                DB::beginTransaction();
                // return book
                $rentData->actual_return_date = Carbon::now()->toDateTimeString();
                $rentData->save();

                // process update book table
                $book = Book::findOrFail($request->book_id);
                $book->status = 'in stock';
                $book->save();
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
            }

            Session::flash('message', 'The book is returned successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect('book-return');
        } else {
            // error notice
            Session::flash('message', 'The book is error process!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book-return');
        }
    }
}
