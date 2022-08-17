<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::group(['as' => 'book.', 'prefix' => 'book'], function () {
        Route::get('/', [App\Http\Controllers\Admin\BookController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\BookController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\BookController::class, 'store'])->name('store');
        Route::get('/{id}', [App\Http\Controllers\Admin\BookController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\BookController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [App\Http\Controllers\Admin\BookController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Admin\BookController::class, 'destroy'])->name('destroy');
    });
    Route::group(['as' => 'genre.', 'prefix' => 'genre'], function () {
        Route::get('/', [App\Http\Controllers\Admin\GenreController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\GenreController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\GenreController::class, 'store'])->name('store');
        Route::get('/{id}', [App\Http\Controllers\Admin\GenreController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\GenreController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [App\Http\Controllers\Admin\GenreController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Admin\GenreController::class, 'destroy'])->name('destroy');
    });
    Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
        Route::get('/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
    });
});

