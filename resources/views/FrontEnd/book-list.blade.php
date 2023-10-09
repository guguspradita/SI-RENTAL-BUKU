@extends('BackEnd.layouts.main')
@section('title', 'Selamat Datang di rental kami')
@section('menuDashboard', 'active')

@section('content')
    <div class="row">
        @foreach ($books as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <img src="{{ asset('images/no_cover.jpg') }}" class="card-img-top" alt="..." height="250px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->book_code }}</h5>
                        <p class="card-text">{{ $item->title }}</p>
                        <p class="card-text text-end">{{ $item->status }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
