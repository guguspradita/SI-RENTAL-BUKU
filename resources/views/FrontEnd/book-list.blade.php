@extends('BackEnd.layouts.main')
@section('title', 'Selamat Datang di rental kami')
@section('menuDashboard', 'active')

@section('content')
    <div class="row">
        @foreach ($books as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <img src="{{ $item->cover != '' ? asset('storage/cover/' . $item->cover) : asset('images/no_cover.jpg') }}"
                        class="card-img-top" draggable="false" height="250px">
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
