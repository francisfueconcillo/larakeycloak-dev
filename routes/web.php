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

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/sample/admin', 'SampleAdminController@index')->name('sample-admin');
});

Auth::routes();

Route::get('/auth/redirect', 'LaraKeycloakController@redirect')->name('auth-redirect');
Route::get('/auth/callback', 'LaraKeycloakController@callback')->name('auth-callback');


