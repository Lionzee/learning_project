<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('API')->group(function () {
    Route::post('register','UserController@register');
    Route::post('login','UserController@login');

    Route::middleware('jwt.verify')->group(function (){
        Route::get('/user', 'UserController@getAuthenticatedUser');
        Route::post('/profile', 'UserController@editProfile');
        Route::get('/profile', 'UserController@getProfile');

        Route::get('/topic', 'TopicController@index');
        Route::post('/topic', 'TopicController@store');
        Route::post('/topic/{topic_id}', 'TopicController@update');
        Route::delete('/topic/delete/{topic_id}', 'TopicController@destroy');




    });

});
