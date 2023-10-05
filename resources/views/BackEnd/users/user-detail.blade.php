@extends('BackEnd.layouts.main')
@section('title', 'Detail user')

@section('content')
    <h1>Detail User</h1>
    <div class="mt-2 d-flex justify-content-end">
        @if ($user->status == 'inactive')
            <a href="/user-approve/{{ $user->slug }}" class="btn btn-info">Approve User</a>
        @endif
    </div>

    <div class="my-5">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session('success') }}
            </div>
        @endif
    </div>

    <div class="my-5">
        <div class="mb-3 w-25">
            <label for="" class="form-label">Username</label>
            <input type="text" class="form-control" readonly value="{{ $user->username }}">
            <div class="mb-3">
                <label for="" class="form-label">Phone</label>
                <input type="text" class="form-control" readonly value="{{ $user->phone }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Address</label>
                <textarea name="" id="" cols="30" rows="5" class="form-control" style="resize: none"
                    readonly>{{ $user->address }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Status</label>
                <input type="text" class="form-control" readonly value="{{ $user->status }}">
            </div>
        </div>
    </div>
@endsection
