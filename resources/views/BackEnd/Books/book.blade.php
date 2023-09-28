@extends('BackEnd.layouts.main')
@section('title', 'Dashboard')

@section('content')
    <h1>Books List</h1>

    <div class="mt-2 d-flex justify-content-end">
        {{-- <a href="book-deleted" class="btn btn-secondary me-3">View Deleted Data</a> --}}
        <a href="book-add" class="btn btn-primary">Add Data</a>
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
                        <th scope="col">No.</th>
                        <th scope="col">Code Book</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->book_code }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <a href="category-edit/{{ $item->slug }}" class="btn btn-success btn-sm me-2"><i class="bi bi-pencil-square"></i></a>
                                <form action="category-delete/{{ $item->slug }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('yakin ingin menghapus?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
