<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/email/verify/{id}/{hash}', function (
    EmailVerificationRequest $request
) {

    $request->fulfill();

    return view('email-verified');

})->middleware([
    'signed'
])->name('verification.verify');