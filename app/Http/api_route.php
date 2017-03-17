<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['prefix' =>'api'], function () {
    Route::post('/login_post',                          'WelcomeController@login_post')->name('login_post');
    Route::post('/registration_post',                   'WelcomeController@registration_post')->name('registration_post');
});