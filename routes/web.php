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
    return view('welcome');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/auth/home', 'HomeController@index')->name('home');
});

// // protected endpoints
// Route::group(['middleware' => 'auth:web'], function () {
//     Route::get('/home', 'HomeController@index')->name('home');

//     // Route::get('/protected-endpoint', 'SecretController@index');
//     // more endpoints ...
// });