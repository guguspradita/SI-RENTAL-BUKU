@extends('BackEnd.layouts.main')
@section('title', 'Add Books')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('content')
    <h2>Add New Book</h2>
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
                <input type="text" name="book_code" class="form-control" id="code" placeholder="Book Name"
                    value="{{ old('book_code') }}">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter the book title"
                    value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="cover" class="form-label">Cover</label>
                <input type="file" name="cover" id="cover" class="form-control">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="categories[]" id="category" class="form-select select-multiple" multiple aria-label="Default select example">
                    {{-- <option value="">Choose Category</option> --}}
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success" type="submit">Save</button>
            <a href="/books" class="btn btn-primary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select-multiple').select2();
        });
    </script>
@endsection
