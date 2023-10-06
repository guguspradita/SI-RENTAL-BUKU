@extends('BackEnd.layouts.main')
@section('title', 'Dashboard Users')

@section('content')
    <h1>User List</h1>

    <div class="mt-2 d-flex justify-content-end">
        <a href="/users-deleted" class="btn btn-secondary me-3">View Banned User</a>
        <a href="/registed-users" class="btn btn-primary">New Registered User</a>
    </div>

    <div class="my-5">
        <div class="table-responsive">
            <table class="table table-hover border border-2">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->username }}</td>
                            <td>
                                @if ($item->phone)
                                    {{ $item->phone }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="/user-detail/{{ $item->slug }}" class="btn btn-success btn-sm me-2"><i
                                        class="bi bi-info-circle me-2"></i>Detail</a>
                                <form action="/user-delete/{{ $item->slug }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('yakin ingin menghapus?')">
                                        <i class="bi bi-trash me-2"></i>Banned
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
