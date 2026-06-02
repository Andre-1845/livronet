<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
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

});
