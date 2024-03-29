<?php

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

Route::namespace('Admin')->name('admin')->group(function (){
    Route::get('login', 'HomeController@login')->name('login');
    Route::prefix('admin')->group(function (){
        Route::get('/home', 'HomeController@index')->name('.home');
        Route::get('/user','UserController@index')->name('.user.index');
        Route::get('/user/{id}','UserController@show')->name('.user.show');
        Route::post('/user/{id}','UserController@update')->name('.user.update');
    });

});

Route::get('/', function () {
    return redirect( route('login')) ;
});


Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();
