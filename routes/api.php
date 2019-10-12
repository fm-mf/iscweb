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

/**
 * Routes for authentication
 * Namespace: Api
 * Middleware: api
 * Prefix: api
 */

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

    Route::post('/avatar', 'AvatarController@upload');
    Route::post('/load', 'ApiController@load');

    Route::post('/autocomplete/exchange-students', 'AutocompleteController@exchangeStudents');
    Route::post('/autocomplete/buddies', 'AutocompleteController@buddies');
    Route::post('/liststudents', 'ApiController@load');

    Route::post('/load-preregister', 'ApiController@loadPreregister');
    Route::post('/load-preregister/save', 'ApiController@preregister');

    Route::get('/trips', 'TripsAppController@index');
    Route::post('/trips', 'TripsAppController@index');

    Route::post('/github', ['middleware' => 'github.secret.token', 'uses' => 'GithubController@githubUpdate']);
    Route::get('/github', ['middleware' => 'github.secret.token', 'uses' => 'GithubController@githubUpdate']);

    Route::post('/events/getExchangeStudent', 'EventsController@getExchangeStudent');
    Route::post('/events/getBuddy', 'EventsController@login');
    Route::post('/events/register', 'EventsController@register');
