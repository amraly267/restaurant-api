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


Route::get('check-table-availability', 'ReservationController@checkTableAvailability');
Route::post('reserve-table', 'ReservationController@reserveTable');
Route::get('menu', 'MealController@menu');
Route::post('place-order', 'OrderController@placeOrder');
Route::get('invoice', 'OrderController@printInvoice');
