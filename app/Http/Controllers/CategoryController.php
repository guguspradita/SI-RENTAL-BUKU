<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('BackEnd.category', ["categories" => $category]);
    }

    public function add()
    {
        return view('BackEnd.category-add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = Category::create($request->all());
        return redirect('categories')->with(['success' => 'Data Berhasi Tersimpan!']);
    }
}
