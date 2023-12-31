<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        if ($request->category || $request->title) {
            $books = Book::where('title', 'like', '%' . $request->title . '%')
                ->orWhereHas('categories', function ($search) use ($request) {
                    $search->where('categories.id', $request->category);
                })->get();
        } else {
            $books = Book::all();
        }
        $categories = Category::all();
        return view('FrontEnd.book-list', ['books' => $books, 'categories' => $categories]);
    }
}
