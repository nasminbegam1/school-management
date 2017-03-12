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
Route::any('/registration',                 'UserController@registration')->name('registration');
Route::any('/active-by-user/{token}',       'UserController@active_by_user')->name('active_by_user');
Route::any('/thank-you',                    'UserController@thank_you')->name('thank_you');
Route::group(['middleware' => ['user']], function () {
Route::any('/dashboard',                    'UserController@dashboard')->name('dashboard');
Route::get('/edit-profile',                 'UserController@edit_profile')->name('edit_profile');
Route::post('/edit_profile_store',          'UserController@edit_profile_store')->name('edit_profile_store');
Route::get('/account-settings',             'UserController@account_settings')->name('account_settings');
Route::post('/account-update',              'UserController@account_update')->name('account_update');
Route::any('/logout',                       'UserController@logout')->name('logout');
Route::any('/screen-list',                  'ScreenController@index')->name('screen_list');
Route::get('/screen-create',                'ScreenController@create')->name('screen_create');
Route::post('/screen-store',                'ScreenController@store')->name('screen_store');
Route::get('/screen-edit/{id}',             'ScreenController@edit')->name('screen_edit');
Route::post('/screen-update/{id}',          'ScreenController@update')->name('screen_update');
Route::get('/screen-delete/{id}',           'ScreenController@delete')->name('screen_delete');
Route::any('/user-list',                    'UserController@lists')->name('user_list');
Route::any('/role-assign/{id}',             'UserController@role_assign')->name('role_assign');
Route::any('/role-assign-update/{id}',      'UserController@role_assign_update')->name('role_assign_update');
Route::any('/usertype-list',                'UsertypeController@index')->name('usertype_list');
Route::get('/usertype-create',              'UsertypeController@create')->name('usertype_create');
Route::post('/usertype-store',              'UsertypeController@store')->name('usertype_store');
Route::get('/usertype-edit/{id}',           'UsertypeController@edit')->name('usertype_edit');
Route::post('/usertype-update/{id}',        'UsertypeController@update')->name('usertype_update');
Route::get('/usertype-delete/{id}',         'UsertypeController@delete')->name('usertype_delete');


Route::group(['prefix' =>'school-modlues'], function () {
    Route::any('/',               'SchoolmoduleController@index')->name('school_modlues');
    Route::any('/add',               'SchoolmoduleController@add')->name('school_modlues_add');
    Route::any('/store',               'SchoolmoduleController@store')->name('school_modlues_store');
    
    Route::any('/edit/{id}',               'SchoolmoduleController@edit')->name('school_modlues_edit');
    Route::any('/update/{id}',               'SchoolmoduleController@update')->name('school_modlues_update');
    Route::any('/delete/{id}',               'SchoolmoduleController@delete')->name('school_modlues_delete');
});

});