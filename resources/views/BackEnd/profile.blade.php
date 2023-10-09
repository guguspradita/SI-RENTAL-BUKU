@extends('BackEnd.layouts.main')
@section('title', 'Dashboard')
@section('title', 'Dashboard Profile')

@section('content')
    {{-- @dd($books) --}}
    <div class="row">
        <div class="col-3">
            @foreach ($books as $item)
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('images/no_cover.jpg') }}" class="card-img-top" alt="..." height="300px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <a href="/detail-book" class="btn btn-primary ">Go somewhere</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
