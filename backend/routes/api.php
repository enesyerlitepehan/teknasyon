<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('device', 'DeviceController');
Route::resource('purchase', 'PurchaseController');

Route::group(['prefix' => 'device'], function () {
    Route::get('/', 'DeviceController@index');
    Route::post('/', 'DeviceController@store');
    Route::put('/', 'DeviceController@update');
    Route::delete('/{id}', 'DeviceController@destroy');
});

Route::group(['prefix' => 'purchase'], function () {
    Route::post('/', 'PurchaseController@store');
});

Route::get('/check_subscription/{token}', 'DeviceController@show');

