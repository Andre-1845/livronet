<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\IsbnController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\SubjectController;
use Illuminate\Support\Facades\Route;

// ---------------- AUTH ----------------

Route::middleware('throttle:6,1')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

});

// ---------------- PUBLIC ROUTES ----------------

Route::get('/cities', [CityController::class, 'index']);

Route::get('/schools', [SchoolController::class, 'index']);

Route::post('/schools', [SchoolController::class, 'store']);

Route::get('/subjects', [SubjectController::class, 'index']);

Route::get('/grades', [GradeController::class, 'index']);

Route::get('/states', [StateController::class, 'index']);

// ---------------- PROTECTED ROUTES ----------------

Route::middleware('auth:sanctum')->group(function () {

    // ---- Acessível mesmo sem e-mail confirmado ----
    // (o usuário precisa conseguir ver o próprio status,
    // reenviar confirmação, sair, ou corrigir o e-mail
    // mesmo antes de verificar)

    Route::get('/me', [AuthController::class, 'me']);

    Route::put('/me', [AuthController::class, 'updateProfile']);

    Route::post('/change-email', [AuthController::class, 'changeEmail']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get(
        '/email-status',
        [AuthController::class, 'emailStatus']
    );

    Route::post(
        '/email-resend',
        [AuthController::class, 'resendVerificationEmail']
    );

    // ---- Exige e-mail confirmado ----

    Route::middleware('verified')->group(function () {

        Route::get('/books', [BookController::class, 'index']);

        Route::get('/books/{book}', [BookController::class, 'show']);

        Route::post('/books', [BookController::class, 'store']);

        Route::put('/books/{book}', [BookController::class, 'update']);

        Route::delete('/books/{book}', [BookController::class, 'destroy']);

        Route::get(
            '/my-books',
            [BookController::class, 'myBooks']
        );

        Route::post(
            '/favorites/{book}',
            [FavoriteController::class, 'store']
        );

        Route::delete(
            '/favorites/{book}',
            [FavoriteController::class, 'destroy']
        );

        Route::get(
            '/favorites',
            [FavoriteController::class, 'index']
        );

        Route::get(
            '/conversations',
            [ConversationController::class, 'index']
        );

        Route::get(
            '/conversations/{conversation}',
            [ConversationController::class, 'show']
        );

        Route::delete(
            '/conversations/{conversation}',
            [ConversationController::class, 'destroy']
        );

        Route::post(
            '/conversations/{conversation}/messages',
            [MessageController::class, 'store']
        );

        Route::post(
            '/conversations',
            [ConversationController::class, 'store']
        );

        Route::get(
            '/books/isbn/{isbn}',
            [IsbnController::class, 'show']
        );

    });

});
