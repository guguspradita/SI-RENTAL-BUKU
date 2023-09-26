@extends('BackEnd.layouts.main')
@section('title', 'Add Category')

@section('content')
    <h2>Add New Category</h2>

    <div class="mt-5 w-75">
        <form action="category-add" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Category Name">
            </div>
            <button class="btn btn-success" type="submit">Save</button>
        </form>
    </div>
@endsection
