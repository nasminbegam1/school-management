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

Route::any('/',                             'UserController@login')->name('login');
Route::any('/dashboard',                    'UserController@dashboard')->name('dashboard');
Route::any('/screen-list',                  'ScreenController@index')->name('screen_list');
Route::get('/screen-create',                'ScreenController@create')->name('screen_create');
Route::post('/screen-store',                'ScreenController@store')->name('screen_store');
Route::get('/screen-edit/{id}',             'ScreenController@edit')->name('screen_edit');
Route::post('/screen-update/{id}',          'ScreenController@update')->name('screen_update');
Route::get('/screen-delete/{id}',           'ScreenController@delete')->name('screen_delete');