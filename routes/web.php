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

if (Request::segment(1) == "user") {
    App::setLocale('cs');
}



Route::group(['namespace' => 'Exchange', 'prefix' => 'exchange'], function()
{
    Route::get('/{hash}', 'ProfileController@showProfileForm');
    Route::patch('/', 'ProfileController@updateProfile');
});


Route::get('/stats', 'Stats\StatsController@showStatistics');
Route::get('/owstats', 'Stats\StatsController@showOwTripsStatistics');

Route::get('/visa', function() {
   return redirect('https://goo.gl/forms/4VyVa30v0estkh293');
});


Route::get('buddy-prirucka', function () { return redirect(asset('files/buddyPriruckaSpring2017.pdf')); });
//redirect from old web
Route::get('/buddy/files/buddyPriruckaSpring2017.pdf', function () { return redirect(asset('files/buddyPriruckaSpring2017.pdf')); });

Route::group(['namespace' => 'Web', 'prefix' => ''], function()
{
    Route::get('/', 'WebController@showHomePage');
    Route::get('/about-us', function() { return view('web.about'); });
    Route::get('/buddy-program', function() { return view('web.buddy-program'); });
    Route::get('/activities', function() { return view('web.activities'); });
        Route::get('/activities/language-programs', 'WebController@showLanguagesTable');
        Route::get('/activities/sports', function() { return view('web.activities.sports'); });
        Route::get('/activities/integreat', 'WebController@showInteGreatTable');
        Route::get('/activities/trips', function() { return view('web.activities.trips'); });
    Route::get('/contact', 'WebController@showContacts');
    Route::get('/calendar', 'WebController@showCalendar');
    Route::get('/buddy', function () { return view('web.buddy'); });
    Route::get('/nas', function () { return redirect('https://147.32.97.62:5001'); });
});

// Survival Guide
Route::group(['namespace' => 'Guide', 'prefix' => 'guide'], function() {
   Route::get('/', 'PageController@showPage');

    Route::get('/{page}', 'PageController@showPage');
});
//Restart password from old web
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');

