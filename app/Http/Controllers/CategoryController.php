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
        return view('BackEnd.categories.category', ["categories" => $category]);
    }

    public function add()
    {
        return view('BackEnd.categories.category-add');
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
        return redirect('categories')->with(['success' => 'Category Berhasil Tersimpan!']);
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('BackEnd.categories.category-edit', ['category' => $category]);
    }

    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect('categories')->with(['success' => 'Category Berhasil Terupdate!']);
    }

    public function delete($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();

        return redirect('categories')->with(['success' => 'Category Berhasil Dihapus!']);
    }

    public function deleteCategory()
    {
        $category = Category::onlyTrashed()->get();
        return view('BackEnd.categories.category-delete', ['deletedCategories' => $category]);
    }

    public function restore($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->restore();
        return redirect('categories')->with(['success' => 'Category Restore Berhasil Dikembalikan!']);
    }
}
