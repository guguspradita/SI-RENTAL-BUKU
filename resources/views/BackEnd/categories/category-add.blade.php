@extends('BackEnd.layouts.main')
@section('title', 'Add Category')

@section('content')
    <h2>Add New Category</h2>
    <div class="mt-4 w-75">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="mt-4 w-75">
        <form action="category-add" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Category Name">
            </div>
            <button class="btn btn-success" type="submit">Save</button>
            <a href="/categories" class="btn btn-primary">Cancel</a>
        </form>
    </div>
@endsection
