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

Auth::routes();

Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('/home', 'HomeController@index')->name('dashboard');

Route::get('/settings', 'PagesController@settings')->name('settings');
Route::resource('/rates' , 'RateController');
Route::resource('/transactions' , 'TransactionController');
Route::resource('/history' , 'HistoryController');
Route::resource('/factors' , 'FactorController');

Route::get('users/fanapUsers', 'UsersController@indexFanap')->name('indexFanap');
Route::get('users/exhouseUsers', 'UsersController@indexExhouse')->name('indexExhouse');
Route::get('users/otherUsers', 'UsersController@indexOther')->name('indexOther');
Route::get('users/fanapUsers/{client}', 'UsersController@showFanapUser');
Route::put('users/authorization/{client}', 'UsersController@authorizeUser');

Route::get('import-export-csv-excel',array('as'=>'excel.import','uses'=>'UsersController@importExportExcelORCSV'));
Route::post('import-csv-excel',array('as'=>'import-csv-excel','uses'=>'UsersController@importFileIntoDB'));
Route::get('download-excel-file/{type}', array('as'=>'excel-file','uses'=>'UsersController@downloadExcelFile'));

Route::post('ex-add-user',array('as'=>'ex-add-user','uses'=>'UsersController@add_auth_user'));
Route::get('ex-auth-users',array('as'=>'ex-auth-users','uses'=>'UsersController@show_authorized_users'));

Route::resource('/users' , 'UsersController');

Route::get('/search/transactions','TransactionController@search');
Route::get('/search/histories','HistoryController@search');
Route::get('/search/users/exhouse','UsersController@search');
Route::get('/search/users/fanap','UsersController@searchFanap');
Route::get('/search/users/other','UsersController@searchOther');

Route::get('/excel/special','HomeController@special_transaction_excel')->name('admin.special.excel');
Route::get('/excel/history','HistoryController@historyExcel')->name('admin.history.excel');
Route::get('/excel/otherUsers','UsersController@otherUsersExcel')->name('admin.otherUsers.excel');
Route::get('/excel/fanapUsers','HistoryController@excel')->name('admin.fanapUsers.excel');
Route::get('/excel/transactions','TransactionController@transactionsExcel')->name('admin.transactions.excel');


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