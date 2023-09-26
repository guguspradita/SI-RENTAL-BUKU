@extends('BackEnd.layouts.main')
@section('title', 'Category')

@section('content')
    <h1>Category List</h1>

    <div class="my-5">
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
                    @foreach ($categories as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="#">edit</a>
                                <a href="#">delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection