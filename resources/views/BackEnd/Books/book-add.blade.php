@extends('BackEnd.layouts.main')
@section('title', 'Add Books')

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
        <form action="book-add" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="code" class="form-label">Code Book</label>
                <input type="text" name="book_code" class="form-control" id="code" placeholder="Book Name" value="{{ old('book_code') }}">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter the book title" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="cover" class="form-label">Cover</label>
                <input type="file" name="cover" id="cover" class="form-control">
            </div>

            <button class="btn btn-success" type="submit">Save</button>
            <a href="/books" class="btn btn-primary">Cancel</a>
        </form>
    </div>
@endsection
