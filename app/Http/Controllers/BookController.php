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
            'code_book' => 'required|unique:books|max:255',
            'title' => 'required|unique:books|max:255',
        ]);

        $book = new Book([
            'code_book' => $request->code_book,
            'slug' => Str::slug($request->title),
        ]);
        $book->save();
        return redirect('categories')->with(['success' => 'New Book Berhasil Tersimpan!']);
    }
}
