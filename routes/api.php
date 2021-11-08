<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api',], function ($router) {

    Route::post('login', [AuthController::class, 'login'])->middleware('verified');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);

    Route::resource('user',UserController::class);

    Route::get('/email/verify/{id}/{token}',[AuthController::class, 'verify'] );
});
