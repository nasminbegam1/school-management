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

Route::any('/', 'UserController@login')->name('login');
Route::get('/screen-list', 'ScreenController@index')->name('screen_list');
Route::get('/screen-create', 'ScreenController@create')->name('screen_create');