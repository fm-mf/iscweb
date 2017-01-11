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


Route::group(['namespace' => 'Buddyprogram', 'prefix' => 'mujbuddy'], function()
{
    Route::get('/', 'ListingController@index')->middleware('auth');
    Route::get('/list', 'ListingController@listExchangeStudents')->middleware('auth');
});

Route::group(['namespace' => 'Auth', 'prefix' => 'user'], function ()
{
    App::setLocale('cs');
    Route::get('/', 'LoginController@showLoginForm');
    Route::post('/', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout');

    Route::get('/register', 'RegisterController@showRegistrationForm');
    Route::post('/register', 'RegisterController@register');

    Route::get('/profile', 'ProfileController@showProfileForm');
    Route::patch('/profile', 'ProfileController@updateProfile');

    Route::get('/verify', 'ProfileController@showVerificationForm');
    Route::post('/verify', 'ProfileController@processVerificationForm');

    Route::get('/verification-info', 'ProfileController@showVerificationInfo');
    Route::get('/verify/{hash}', 'ProfileController@showVerifyEmail');

    Route::get('/complete', 'ProfileController@complete');
});

Route::group(['namespace' => 'Api', 'prefix' => 'api'], function()
{
    Route::post('/avatar', 'AvatarController@upload');
    Route::post('/load', 'ApiController@load');
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
