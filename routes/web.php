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

    // write some code about service container and service providers.

    //$this->app()->bind()      //use for bind new service to the Service Container.

    //$this->app()->make()      // use for make instance for this Services to use anywhere.

    return view('welcome');
});
