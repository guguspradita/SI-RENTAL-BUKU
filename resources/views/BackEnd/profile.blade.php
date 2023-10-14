@extends('BackEnd.layouts.main')
@section('title', 'Profile')

@section('content')
    <div class="">
        <h2 class="mb-4">Your Rent Log</h2>
        <x-rent-log-table :rentlog='$rentlogs' />
    </div>
@endsection
