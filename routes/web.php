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

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function() {
    Route::resource('/post', 'PostsController');
    Route::resource('/gallery', 'GalleryController');
    Route::resource('/about', 'AboutController');
    Route::resource('/cover', 'CoverController');
    Route::resource('/client', 'ClientController');
});

Auth::routes();

Route::get('/home', ['as' => 'dashboard', 'uses' => 'HomeController@index'])->middleware('auth');

Route::get('/rate', 'PagesController@rate')->name('rate');
Route::get('/transactions', 'PagesController@transactions')->name('transactions');
Route::get('/factors', 'PagesController@factors')->name('factors');
Route::get('/settings', 'PagesController@settings')->name('settings');