<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\SubjectController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);

    Route::post('/logout', [AuthController::class, 'logout']);

    // ----------------  BOOKS  -----------------------

    Route::get('/books', [BookController::class, 'index']);

    Route::post('/books', [BookController::class, 'store']);

    Route::get('/books/{book}', [BookController::class, 'show']);

    Route::put('/books/{book}', [BookController::class, 'update']);

    Route::delete('/books/{book}', [BookController::class, 'destroy']);

    // --------------
    Route::get('/cities', [CityController::class, 'index']);
    Route::get('/schools', [SchoolController::class, 'index']);
    Route::get('/subjects', [SubjectController::class, 'index']);
});
