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

//use Illuminate\Routing\Route;
//use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function() {
//    Route::resource('/post', 'PostsController');
//    Route::resource('/gallery', 'GalleryController');
//    Route::resource('/about', 'AboutController');
//    Route::resource('/cover', 'CoverController');
//    Route::resource('/client', 'ClientController');
});

Auth::routes();

Route::get('/home', ['as' => 'dashboard', 'uses' => 'HomeController@index'])->middleware('auth');

//Route::get('/rates', 'PagesController@rate')->name('rates');
//Route::get('/transactions', 'PagesController@transactions')->name('transactions');
//Route::get('/history', 'PagesController@history')->name('history');
Route::get('/factors', 'PagesController@factors')->name('factors');
Route::get('/settings', 'PagesController@settings')->name('settings');
Route::resource('/rates' , 'RateController');
Route::resource('/transactions' , 'TransactionController');
Route::resource('/history' , 'HistoryController');

Route::get('/search/{search}','TransactionController@search');

Route::get('/test','TransactionController@excel');
Route::get('/transactions/excel','TransactionController@excel')->name('admin.transactions.excel');



// ** just for ex-house dev.
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
//    dd($exitCode);
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
//Route::get('/route-cache', function() {
//    $exitCode = Artisan::call('route:cache');
//    return '<h1>Routes cached</h1>';
//});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});