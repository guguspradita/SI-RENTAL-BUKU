@extends('BackEnd.layouts.main')
@section('title', 'Selamat Datang di rental kami')
@section('menuDashboard', 'active')

@section('content')
    <form action="" method="get">
        <div class="row">
            <div class="col-12 col-sm-6">
                <select name="category" id="category" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6">
                <div class="input-group mb-3">
                    <input type="text" name="title" class="form-control" placeholder="Search book's title">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </div>
    </form>

    <div class="my-5 row">
        @foreach ($books as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img src="{{ $item->cover != '' ? asset('storage/cover/' . $item->cover) : asset('images/no_cover.jpg') }}"
                        class="card-img-top p-2" draggable="false" height="250px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->book_code }}</h5>
                        <p class="card-text">{{ $item->title }}</p>
                        <p
                            class="card-text text-end fw-bold {{ $item->status == 'in stock' ? 'text-success' : 'text-danger' }}">
                            {{ $item->status }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
