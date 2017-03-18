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


Route::get('/',                             'WelcomeController@login')->name('login');
Route::post('/login_post',                  'WelcomeController@login_post')->name('login_post');
Route::any('/forgot-password',              'WelcomeController@forgot_password')->name('forgot_password');
Route::any('/forgot-password-post',         'WelcomeController@forgot_password_post')->name('forgot_password_post');
Route::any('/registration',                 'WelcomeController@registration')->name('registration');
Route::post('/registration_post',           'WelcomeController@registration_post')->name('registration_post');
Route::any('/active-by-user/{token}',       'WelcomeController@active_by_user')->name('active_by_user');
Route::any('/thank-you',                    'WelcomeController@thank_you')->name('thank_you');
Route::group(['middleware' => ['user']], function () {
Route::get('/dashboard',                    'UserController@dashboard')->name('dashboard');
Route::get('/edit-profile',                 'UserController@edit_profile')->name('profile_edit');
Route::post('/edit_profile_store',          'UserController@edit_profile_store')->name('edit_profile_store');
Route::get('/account-settings',             'UserController@account_settings')->name('account_settings');
Route::post('/account-update',              'UserController@account_update')->name('account_update');
Route::any('/logout',                       'UserController@logout')->name('logout');
Route::post('/change-status',		    'WelcomeController@change_status')->name('change-status');
Route::any('/role-assign/{id}',             'UserController@role_assign')->name('role_assign');
Route::any('/role-assign-update/{id}',      'UserController@role_assign_update')->name('role_assign_update');


Route::group(['prefix' =>'screen'], function () {
	Route::get('/list',                  'ScreenController@index')->name('screen_list');
	Route::get('/add',                   'ScreenController@create')->name('screen_create');
	Route::post('/store',                'ScreenController@store')->name('screen_store');
	Route::any('/edit/{id}',             'ScreenController@edit')->name('screen_edit');
	Route::post('/update/{id}',          'ScreenController@update')->name('screen_update');
	Route::get('/delete/{id}',           'ScreenController@delete')->name('screen_delete');

});

Route::group(['prefix' =>'user'], function () {
	Route::any('/list',                    'UserController@lists')->name('user_list');
});
Route::group(['prefix' =>'usertype'], function () {
	Route::get('/list',                'UsertypeController@index')->name('usertype_list');
	Route::get('/add',                 'UsertypeController@create')->name('usertype_create');
	Route::post('/store',              'UsertypeController@store')->name('usertype_store');
	Route::get('/edit/{id}',           'UsertypeController@edit')->name('usertype_edit');
	Route::post('/update/{id}',        'UsertypeController@update')->name('usertype_update');
	Route::get('/delete/{id}',         'UsertypeController@delete')->name('usertype_delete');

});
Route::group(['prefix' =>'school-modlues'], function () {
    Route::get('/list',               'SchoolmoduleController@index')->name('school_modlues_list');
    Route::get('/add',               'SchoolmoduleController@add')->name('school_modlues_add');
    Route::post('/store',               'SchoolmoduleController@store')->name('school_modlues_store');
    Route::get('/edit/{id}',               'SchoolmoduleController@edit')->name('school_modlues_edit');
    Route::post('/update/{id}',               'SchoolmoduleController@update')->name('school_modlues_update');
    Route::get('/delete/{id}',               'SchoolmoduleController@delete')->name('school_modlues_delete');
});

});
include('api_route.php');
