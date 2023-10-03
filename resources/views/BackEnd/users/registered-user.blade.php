@extends('BackEnd.layouts.main')
@section('title', 'New Registered User')

@section('content')
    <h2>Add New Users</h2>
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
        <form action="/registed-users" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username"
                    value="{{ old('username') }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password"
                    placeholder="Enter your password">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone"
                    value="{{ old('phone') }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="address" placeholder="Enter your address"
                    value="{{ old('address') }}">
            </div>
            <div class="mt-2">
                <button class="btn btn-success" type="submit">Save</button>
                <a href="/books" class="btn btn-primary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
