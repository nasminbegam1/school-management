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
    
    Route::post('/login_post',                          'WelcomeController@login_post')->name('login_post_api');
    Route::post('/registration_post',                   'WelcomeController@registration_post')->name('registration_post_api');
    Route::any('/forgot-password-post',                 'WelcomeController@forgot_password_post')->name('forgot_password_post_api');
    
    Route::post('/account-update',                      'UserController@account_update')->name('account_update_api');
});