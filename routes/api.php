<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::group(['middleware' => 'auth:api'], function () {
//
//    Route::get('/user', function (Request $request) {
//
//        var_dump(Auth::guard('api')->id());
//    });
//
//    Route::get('/post', function (Request $request) {
//        return $request->user();
//    });
//});

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('jwt.auth');

Route::post('auth', 'Api\AuthController@authenticate');
Route::get('auth/me', 'Api\AuthController@getAuthenticatedUser');

Route::get('gallery','Api\ApiGalleryController@slm')->middleware('jwt.auth');