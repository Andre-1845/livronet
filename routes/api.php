<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\SubjectController;
use Illuminate\Support\Facades\Route;

// ---------------- AUTH ----------------

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

// ---------------- PUBLIC ROUTES ----------------

Route::get('/books', [BookController::class, 'index']);

Route::get('/books/{book}', [BookController::class, 'show']);

Route::get('/cities', [CityController::class, 'index']);

Route::get('/schools', [SchoolController::class, 'index']);

Route::get('/subjects', [SubjectController::class, 'index']);

Route::get('/grades', [GradeController::class, 'index']);

// ---------------- PROTECTED ROUTES ----------------

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);

    Route::put('/me', [AuthController::class, 'updateProfile']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/books', [BookController::class, 'store']);

    Route::put('/books/{book}', [BookController::class, 'update']);

    Route::delete('/books/{book}', [BookController::class, 'destroy']);

    Route::get(
        '/my-books',
        [BookController::class, 'myBooks']
    );

});
