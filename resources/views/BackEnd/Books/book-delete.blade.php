@extends('BackEnd.layouts.main')
@section('title', 'Deleted Book List')

@section('content')
    <h1>Deleted Book List</h1>

    <div class="mt-2 d-flex justify-content-end">
        <a href="/books" class="btn btn-primary">Back To Book List</a>
    </div>

    <div class="my-4">
        @if (Session::has('success'))
            <div class="alert alert-primary">
                {{ Session('success') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-hover border border-2">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Code Book</th>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deletedBook as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->book_code }}</td>
                            <td>{{ $item->title }}</td>
                            <td><a href="category-restore/{{ $item->slug }}" class="btn btn-success btn-sm me-2"
                                    onclick="return confirm('yakin ingin mengembalikan data?')"><i
                                        class="bi bi-arrow-clockwise"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
