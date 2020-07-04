<?php

use Illuminate\Http\Request;

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

Route::prefix('/v1')->group(function () {
    Route::prefix('boxes')->group(function () {
        Route::get('/{id?}', '\App\Http\Controllers\Api\V1\BoxController@get');
        Route::post('/create', '\App\Http\Controllers\Api\V1\BoxController@create');
        Route::post('/delete', '\App\Http\Controllers\Api\V1\BoxController@delete');
    });
    Route::prefix('records')->group(function () {
        Route::get('/{param}', '\App\Http\Controllers\Api\V1\RecordController@get');
        Route::post('/create', '\App\Http\Controllers\Api\V1\RecordController@create');
        Route::post('/delete', '\App\Http\Controllers\Api\V1\RecordController@delete');
    });
});
