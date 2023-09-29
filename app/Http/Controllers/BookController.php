<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
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
        $categories = Category::all();
        return view('BackEnd.Books.book-add', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255',
            'cover' => 'file|mimes:jpeg,png,jpg,svg|max:5120',
        ]);

        // validasi gambar
        $newName = '';
        if ($request->file('cover')) {
            $extension = $request->file('cover')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->file('cover')->storeAs('cover', $newName);
        }

        $request['slug'] = str::slug($request->title);
        $request['cover'] = $newName;

        $book = Book::create($request->all());
        $book->categories()->sync($request->categories); // sync relationship model book
        return redirect('/books')->with(['success' => 'New Book Berhasil Tersimpan!']);
    }

    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $category = Category::all();
        return view('BackEnd.Books.book-edit', ['book' => $book, 'categories' => $category]);
    }

    public function update(Request $request, $slug)
    {

    }
}
