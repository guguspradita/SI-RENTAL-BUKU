<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::all();
        return view('BackEnd.Books.book', ['books' => $books]);
    }

    public function add()
    {
        return view('BackEnd.Books.book-add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255',
            // 'cover' => 'required|file|mimes:jpeg,png,jpg,svg|max:5120',
        ]);

        $book = new Book([
            'book_code' => $request->book_code,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
        ]);
        $book->save();
        return redirect('/books')->with(['success' => 'New Book Berhasil Tersimpan!']);
    }
}
