@extends('BackEnd.layouts.main')
@section('title', 'Deleted List Category')

@section('content')
    <h1>Deleted User List</h1>

    <div class="mt-2 d-flex justify-content-end">
        <a href="/users" class="btn btn-primary">Back To User List</a>
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
                    @forelse ($deleteUser as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->username }}</td>
                            <td><a href="user-restore/{{ $item->slug }}" class="btn btn-success btn-sm me-2"
                                    onclick="return confirm('yakin ingin mengembalikan data?')"><i
                                        class="bi bi-arrow-clockwise"></i></a></td>
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
