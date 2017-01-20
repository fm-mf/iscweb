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

// Redirect legacy links
Route::get('/muj-buddy/register/update-exchange-profile/{hash}', function($hash) {
    return redirect('/exchange/' . $hash);
});

Route::group(['middleware' => 'checkpartak', 'namespace' => 'Partak', 'prefix' => 'partak'], function()
{
    Route::get('/', 'DashboardController@index');
    //Route::get('/mail', 'DashboardController@mail')->middleware('can:partaknet');
});


Route::group(['middleware' => 'checkbuddy', 'namespace' => 'Buddyprogram', 'prefix' => 'muj-buddy'], function()
{
    Route::get('/', 'ListingController@listExchangeStudents')->middleware('auth');
    Route::get('/list', 'ListingController@listExchangeStudents')->middleware('auth');
    Route::get('/profile/{id}', 'StudentController@showProfile')->middleware('auth');
    Route::get('/become-buddy/{id}', 'StudentController@assignBuddy')->middleware('auth');
    Route::get('/my-students/', 'ListingController@listMyStudents')->middleware('auth');
    Route::get('/closed/', 'ListingController@showClosed')->middleware('auth');
});

Route::group(['namespace' => 'Auth', 'prefix' => 'user'], function ()
{
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

    Route::get('/verify/{hash}', 'ProfileController@verifyBuddy');
    Route::post('/noemail', 'ProfileController@processNoEmail');

    Route::get('/thankyou', 'ProfileController@showThanks');
});

Route::group(['namespace' => 'Exchange', 'prefix' => 'exchange'], function()
{
    Route::get('/{hash}', 'ProfileController@showProfileForm');
    Route::patch('/', 'ProfileController@updateProfile');
});

Route::group(['namespace' => 'Api', 'prefix' => 'api'], function()
{
    Route::post('/avatar', 'AvatarController@upload');
    Route::post('/load', 'ApiController@load');

    Route::post('/liststudents', 'ApiController@load');
});

Route::get('/stats', 'Stats\StatsController@showStatistics');


Route::get('buddy-prirucka', function () { return redirect(asset('files/buddyPriruckaSpring2017.pdf')); });
//redirect from old web
Route::get('/buddy/files/buddyPriruckaSpring2017.pdf', function () { return redirect(asset('files/buddyPriruckaSpring2017.pdf')); });

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
    Route::get('/buddy', function () { return "Buddy page"; });
});

// Survival Guide
Route::group(['namespace' => 'Guide', 'prefix' => 'guide'], function() {
   Route::get('/', 'PageController@showPage');

    Route::get('/{page}', 'PageController@showPage');
});

