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
        return view('BackEnd.books.book', ['books' => $books]);
    }

    public function add()
    {
        $categories = Category::all();
        return view('BackEnd.books.book-add', ['categories' => $categories]);
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
            $request->cover->storeAs('cover', $newName);
        }

        $book = Book::create([
            'book_code' => $request->book_code,
            'title' => $request->title,
            'cover' => $newName,
            'slug' => str::slug($request->title),
        ]);
        $book->categories()->sync($request->categories); // sync relationship model book
        return redirect('/books')->with(['success' => 'New Book Berhasil Tersimpan!']);
    }

    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        // dd($book);
        $category = Category::all();
        return view('BackEnd.books.book-edit', ['book' => $book, 'categories' => $category]);
    }

    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'book_code' => 'required|max:255',
            'title' => 'required|max:255',
        ]);

        $book = Book::where('slug', $slug)->first();

        // validasi gambar
        if ($request->file('cover')) {
            $extension = $request->file('cover')->getClientOriginalExtension();
            $newName = $request->title . '-' . now()->timestamp . '.' . $extension;
            $request->cover->storeAs('cover', $newName);

            $book->update([
                'book_code' => $request->book_code,
                'title' => $request->title,
                'slug' => str::slug($request->title),
                'cover' => $newName
            ]);
        }

        if ($request->categories) {
            $book->categories()->sync($request->categories); // sync relationship model book
        }

        return redirect('/books')->with(['success' => 'Update Book Berhasil Tersimpan!']);
    }

    public function delete($slug)
    {
        $book = Book::where('slug', $slug)->first();
        // dd($book);
        $book->delete();
        return redirect('/books')->with(['success' => 'Books Berhasil Dihapus!']);
    }

    public function deleteBook()
    {
        $book = Book::onlyTrashed()->get();
        return view('BackEnd.books.book-delete', ['deletedBook' => $book]);
    }
}
