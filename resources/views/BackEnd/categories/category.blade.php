@extends('BackEnd.layouts.main')
@section('title', 'Dashboard Category')

@section('content')
    <h1>Category List</h1>

    <div class="mt-2 d-flex justify-content-end">
        <a href="/category-deleted" class="btn btn-secondary me-3">View Deleted Data</a>
        <a href="/category-add" class="btn btn-primary">Add Data</a>
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
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd($categories) --}}
                    @forelse ($categories as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="/category-edit/{{ $item->slug }}" class="btn btn-success btn-sm me-2"><i
                                        class="bi bi-pencil-square"></i></a>
                                <form action="/category-delete/{{ $item->slug }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('yakin ingin menghapus?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-dark bg-white text-center">Data Masih Kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
