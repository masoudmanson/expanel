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

//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return redirect('login');
//});

//Route::group(['middleware' => 'auth'], function() {
////    Route::resource('/post', 'PostsController');
////    Route::resource('/gallery', 'GalleryController');
////    Route::resource('/about', 'AboutController');
////    Route::resource('/cover', 'CoverController');
////    Route::resource('/client', 'ClientController');
//});
//dd(resolve(App\Essentials\Adapter::class));

Auth::routes();

Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/home', 'HomeController@index')->name('dashboard');
//Route::get('/home', ['as' => 'dashboard', 'uses' => 'HomeController@index'])->middleware('auth');

Route::get('/settings', 'PagesController@settings')->name('settings');
Route::resource('/rates' , 'RateController');
Route::resource('/transactions' , 'TransactionController');
Route::resource('/history' , 'HistoryController');
Route::resource('/factors' , 'FactorController');

Route::get('users/fanapUsers', 'UsersController@indexFanap')->name('indexFanap');
Route::get('users/exhouseUsers', 'UsersController@indexExhouse')->name('indexExhouse');
Route::get('users/otherUsers', 'UsersController@indexOther')->name('indexOther');
Route::put('users/authorization/{client}', 'UsersController@authorizeUser');

Route::resource('/users' , 'UsersController');

Route::get('/search/transactions','TransactionController@search');
Route::get('/search/histories','HistoryController@search');
Route::get('/search/users/exhouse','UsersController@search');
Route::get('/search/users/fanap','UsersController@searchFanap');
Route::get('/search/users/other','UsersController@searchOther');

Route::get('/excel/special','HomeController@special_transaction_excel')->name('admin.special.excel');
Route::get('/excel/history','HistoryController@excel')->name('admin.history.excel');
Route::get('/excel/transactions','TransactionController@excel')->name('admin.transactions.excel');


Route::get('import-export-csv-excel',array('as'=>'excel.import','uses'=>'UsersController2@importExportExcelORCSV'));
Route::post('import-csv-excel',array('as'=>'import-csv-excel','uses'=>'UsersController2@importFileIntoDB'));
Route::get('download-excel-file/{type}', array('as'=>'excel-file','uses'=>'UsersController2@downloadExcelFile'));

Route::post('ex-add-user',array('as'=>'ex-add-user','uses'=>'UsersController2@add_auth_user'));
Route::get('ex-auth-users',array('as'=>'ex-auth-users','uses'=>'UsersController2@show_authorized_users'));


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