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
Auth::routes(['register' => true]);

Route::group(['middleware' => 'auth'], function (){
    Route::group(['middleware' => 'superuser.allow'], function (){
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/admin', 'AccountController@adminIndex')->name('admin.index');
        Route::get('accounts', 'AccountController@index')
            ->name('accounts.index');
    });

    Route::group(['middleware' => 'guest.allow'], function (){

    });
});
