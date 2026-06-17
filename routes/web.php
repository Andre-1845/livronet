<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/email/verify/{id}/{hash}', function (
    Request $request,
    $id,
    $hash
) {

    $user = User::findOrFail($id);

    if (! hash_equals(
        sha1($user->getEmailForVerification()),
        $hash
    )) {

        abort(403);
    }

    if (! $user->hasVerifiedEmail()) {

        $user->markEmailAsVerified();
    }

    return view('email/email-verified');

})->middleware('signed')
  ->name('verification.verify');