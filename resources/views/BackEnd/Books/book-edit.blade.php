@extends('BackEnd.layouts.main')
@section('title', 'Edit Books')

@section('content')
    <h2>Edit Book</h2>
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
        <form action="/book-edit/{{ $book->slug }}" method="POST">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="code" class="form-label">Code Book</label>
                <input type="text" name="book_code" class="form-control" id="code" placeholder="Book Name"
                    value="{{ $book->book_code }}">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter the book title"
                    value="{{ $book->title }}">
            </div>
            <div class="mb-3">
                <label for="cover" class="form-label">Cover</label>
                <input type="file" name="cover" id="cover" class="form-control">
            </div>
            <div class="mb-3">
                <label for="currentCover" class="form-label">Current Cover</label>
                <div class="">
                    @if ($book->cover != '')
                        <img src="{{ asset('storage/cover/' . $book->cover) }}" class="img-responsive border"
                            style="max-width:150px;" alt="">
                    @else
                        <img src="{{ asset('images/no_cover.jpg') }}" class="img-responsive border"
                            style="max-width:150px;" alt="">
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="categories[]" id="category" class="form-select select-multiple" multiple
                    aria-label="Default select example">
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="currentCategory" class="form-label">Current Category</label>
                <ul>
                    @foreach ($book->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
            <button class="btn btn-success" type="submit">Update</button>
            <a href="/books" class="btn btn-primary">Cancel</a>
        </form>
    </div>
@endsection
