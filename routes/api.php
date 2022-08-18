<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'user'], function () {
        //получение токена уже зарегистрированного пользователя
        Route::post('/get_api_token', [\App\Http\Controllers\Api\UserController::class, 'login']);
        //список всех пользователей
        Route::get('/', [\App\Http\Controllers\Api\UserController::class, 'list']);
        //просомтр пользователя
        Route::get('/{id}', [\App\Http\Controllers\Api\UserController::class, 'show']);
        //редактирование пользователя
        Route::put('/{id}', [\App\Http\Controllers\Api\UserController::class, 'update'])->middleware(['token', 'can:user-edit,id']);
    });
    Route::group(['prefix' => 'book'], function () {
        //все книги с авторами
        Route::get('/', [\App\Http\Controllers\Api\BookController::class, 'list']);
        //книга по ид с жанрами и автором
        Route::get('/{id}', [\App\Http\Controllers\Api\BookController::class, 'show']);
        //редактировать книгу
        Route::put('/{id}', [\App\Http\Controllers\Api\BookController::class, 'update'])->middleware('token', 'can:book-edit,id');
        //удалить книгу
        Route::delete('/{id}', [\App\Http\Controllers\Api\BookController::class, 'destroy'])->middleware('token', 'can:book-edit,id');
    });
});
