<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api',], function ($router) {

    Route::post('login', [AuthController::class, 'login'])->middleware('verified');
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::group(['middleware' => 'auth','verified'],function ($router){

        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);

        Route::resource('users',UserController::class);
        Route::post('users/change-password/{id}',[UserController::class,'changePassword']);

    });

    Route::get('/email/verify/{id}/{token}',[AuthController::class, 'verify'] );
});
