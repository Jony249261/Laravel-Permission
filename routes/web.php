<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('products','ProductController');
    Route::get('/test', 'TestController@index')->name('test');
    Route::get('/test-create', 'TestController@create')->name('test.create');
    Route::post('/test-store', 'TestController@store')->name('test.store');
});