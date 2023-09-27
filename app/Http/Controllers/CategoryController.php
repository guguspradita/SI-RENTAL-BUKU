<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
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
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        $category->save();
        return redirect('categories')->with(['success' => 'Data Berhasi Tersimpan!']);
    }
}
