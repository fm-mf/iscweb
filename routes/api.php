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

/**
 * Routes for authentication
 * Namespace: Api
 * Middleware: api
 * Prefix: api
 */

Route::get('/trips', 'TripsAppController@index');
Route::post('/trips', 'TripsAppController@index');

Route::post('/events/getExchangeStudent', 'EventsController@getExchangeStudent');
Route::post('/events/getBuddy', 'EventsController@login');
Route::post('/events/reservation', 'EventsController@createReservation');
Route::put('/events/reservation', 'EventsController@confirmReservation');
Route::delete('/events/reservation/{hash}', 'EventsController@deleteReservation');

Route::get('/ow-trips', 'StatsController@getOwTrips');
