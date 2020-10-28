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
        Route::group(['prefix' => 'admin'], function (){
            Route::get('/', 'AccountController@index')->name('admin.index');
            Route::get('/list-user', 'AccountController@getAll')->name('admin.list-user');
            Route::post('/store', 'AccountController@store')->name('admin.store');
            Route::put('/update', 'AccountController@update')->name('admin.update');
            Route::delete('/user/{id}', 'AccountController@removeUserById')->name('admin.remove');
        });
    });

    Route::group(['middleware' => 'guest.allow'], function (){

    });
});
