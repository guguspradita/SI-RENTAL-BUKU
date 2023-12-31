<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PublicController::class, 'index']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registerProses']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'profile'])->middleware('onlyClient');

    Route::middleware(['onlyAdmin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('/books', [BookController::class, 'index']);
        Route::get('/book-add', [BookController::class, 'add']);
        Route::post('/book-add', [BookController::class, 'store']);
        Route::get('/book-edit/{slug}', [BookController::class, 'edit']);
        Route::post('/book-edit/{slug}', [BookController::class, 'update']);
        Route::delete('/book-delete/{slug}', [BookController::class, 'delete']);
        Route::get('/book-deleted', [BookController::class, 'deleteBook']);
        Route::get('/book-restore/{slug}', [BookController::class, 'restore']);

        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/category-add', [CategoryController::class, 'add']);
        Route::post('/category-add', [CategoryController::class, 'store']);
        Route::get('/category-edit/{slug}', [CategoryController::class, 'edit']);
        Route::put('/category-edit/{slug}', [CategoryController::class, 'update']);
        Route::delete('/category-delete/{slug}', [CategoryController::class, 'delete']);
        Route::get('/category-deleted', [CategoryController::class, 'deleteCategory']);
        Route::get('/category-restore/{slug}', [CategoryController::class, 'restore']);

        Route::get('/users', [UserController::class, 'index']);
        Route::get('/registed-users', [UserController::class, 'registeredUser']);
        Route::get('/user-detail/{slug}', [UserController::class, 'show']);
        Route::get('/user-approve/{slug}', [UserController::class, 'approve']);
        Route::delete('/user-delete/{slug}', [UserController::class, 'delete']);
        Route::get('/users-deleted', [UserController::class, 'deleteUser']);
        Route::get('/user-restore/{slug}', [UserController::class, 'restore']);

        Route::get('/book-rent', [BookRentController::class, 'index']);
        Route::post('/book-rent', [BookRentController::class, 'store']);
        Route::get('/book-return', [BookRentController::class, 'returnBook']);
        Route::post('/book-return', [BookRentController::class, 'saveReturnBook']);

        Route::get('/rent-log', [RentLogController::class, 'index']);
    });
});
