<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group(['namespace' => 'Partak', 'prefix' => 'partak'], function()
{
    Route::get('/', 'DashboardController@index')->middleware('auth');
    //Route::get('/mail', 'DashboardController@mail')->middleware('can:partaknet');
});


Route::group(['namespace' => 'Buddy', 'prefix' => 'mujbuddy'], function()
{
    //Route::get('/', 'BuddyListController@index')->middleware('auth');
});



Route::group(['namespace' => 'Auth', 'prefix' => 'user'], function ()
{
    Route::get('/', 'LoginController@showLoginForm');
    Route::post('/', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout');

    Route::get('/register', 'RegisterController@showRegistrationForm');
    Route::post('/register', 'RegisterController@register');
});

Route::group(['namespace' => 'Web', 'prefix' => ''], function()
{
    Route::get('/', function() { return view('web.home'); });
    Route::get('/about-us', function() { return view('web.about'); });
    Route::get('/buddy-program', function() { return view('web.buddy-program'); });
    Route::get('/activities', function() { return view('web.activities'); });
    Route::get('/activities/language-programs', function() { return view('web.activities.languages'); });
    Route::get('/activities/sports', function() { return view('web.activities.sports'); });
    Route::get('/activities/integreat', function() { return view('web.activities.integreat'); });
    Route::get('/activities/trips', function() { return view('web.activities.trips'); });
    Route::get('/contact', function() { return view('web.contact'); });
    Route::get('/calendar', function() { return view('web.calendar'); });
});
