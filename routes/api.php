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
    Route::get('/user', 'UserController@getAuthenticatedUser');


    Route::middleware('jwt.verify')->group(function (){
        Route::post('/profile', 'UserController@editProfile');
        Route::get('/profile', 'UserController@getProfile');
        Route::namespace('SNS')->group(function (){

            Route::get('/topic', 'TopicController@index');
            Route::post('/topic', 'TopicController@store');
            Route::post('/topic/{topic_id}', 'TopicController@update');
            Route::post('/topic/{topic_id}/copy','TopicController@copy');
            Route::delete('/topic/delete/{topic_id}', 'TopicController@destroy');

            Route::get('/feeds','TopicController@feeds');

            Route::get('/note','NoteController@index');
            Route::get('/topic/{topic_id}/note','NoteController@getNotes');
            Route::post('/topic/{topic_id}/note','NoteController@store');
            Route::post('/note/{note_id}/update','NoteController@update');
            Route::post('/note/{note_id}/copy','NoteController@copy');
            Route::delete('/note/{note_id}', 'NoteController@delete');

            Route::post('/follow/{target_id}','FollowController@store');
            Route::get('/follower/{user_id}','FollowController@getFollower');
            Route::get('/following/{user_id}','FollowController@getFollowing');
            Route::delete('/unfollow/{user_id}','FollowController@unfollow');

            Route::post('/like/{topic_id}','LikeController@store');
            Route::delete('/unlike/{topic_id}','LikeController@unlike');
            Route::get('/topic/{topic_id}/like-details','LikeController@likeDetails');

            Route::get('/topic/{topic_id}/comment','CommentController@getComment');
            Route::post('/topic/{topic_id}/comment','CommentController@store');
            Route::post('/comment/{comment_id}/edit','CommentController@edit');
            Route::delete('/comment/{comment_id}/delete','CommentController@delete');

        });
        Route::namespace('SAQ')->group(function (){

            //Quiz
            Route::post('/quiz', 'QuizController@store');
            Route::get('/quiz', 'QuizController@index');
            Route::put('/quiz/{quiz_id}','QuizController@update');
            Route::delete('/quiz/{quiz_id}','QuizController@delete');
            Route::get('/my-quiz', 'QuizController@myQuiz');


            //Question
            Route::post('/question', 'QuestionController@store');
            Route::get('/question', 'QuestionController@getQuestion');
            Route::put('/question/{question_id}','QuestionController@update');
            Route::delete('/question/{question_id}','QuestionController@delete');

            //Work
            Route::post('/work', 'WorkController@store');
            Route::get('/work', 'WorkController@myWork');
            Route::put('/work/{work_id}','WorkController@update');
            Route::delete('/work/{work_id}','WorkController@delete');


            //Answer Sheet
            Route::get('/answer/sheet', 'AnswerController@getSheet');
            Route::put('/answer/{answer_id}','AnswerController@update');

            //Rating
            Route::post('/rating', 'RatingController@store');
            Route::get('/quiz/{quiz_id}/rating','RatingController@getQuizRating');

        });
    });

});
