<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {
    Route::resource('/post', 'PostsController');
    Route::resource('/gallery', 'GalleryController');
    Route::resource('/about', 'AboutController');
});

Auth::routes();

Route::get('/home', ['as' => 'dashboard', 'uses' => 'HomeController@index'])->middleware('auth');

//Route::group(['middleware' => ['auth']], function() {
//    Route::get('/home', 'HomeController@index')
//});
