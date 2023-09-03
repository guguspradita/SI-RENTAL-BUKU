@extends('BackEnd.layouts.main')
@section('title', 'Dashboard')
@section('menuDashboard', 'active')

@section('content')
    <h1>Welcome, {{ Auth::user()->username }}</h1>
    <div class="row my-5">
        <div class="col-lg-4">
            <div class="card-data book">
                <div class="row">
                    <div class="col-6">
                        <i class="bi bi-journal-bookmark"></i>
                    </div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Books</div>
                        <div class="card-count">{{ $book_count }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-data category">
                <div class="row">
                    <div class="col-6">
                        <i class="bi bi-tags"></i>
                    </div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Categories</div>
                        <div class="card-count">{{ $category_count }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-data user">
                <div class="row">
                    <div class="col-6">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Users</div>
                        <div class="card-count">{{ $user_count }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h2>#Rent Log</h2>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">User</th>
                <th scope="col">Book Title</th>
                <th scope="col">Rent Date</th>
                <th scope="col">Return Date</th>
                <th scope="col">Actual Return Date</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                {{-- <th scope="row">1</th> --}}
                <td colspan="7" style="text-align: center">No Data</td>
              </tr>
            </tbody>
          </table>
    </div>

@endsection
