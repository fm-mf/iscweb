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

use App\Facades\Contacts;

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
   //return redirect('https://goo.gl/forms/4VyVa30v0estkh293');
    return redirect('https://docs.google.com/forms/d/1zys0lGLZ2WlwDeo4yZObTTEjElrudjQs3UDoBCr1-MI/edit');
});


Route::get('kos-manual', function () { return response()->file('files/KOS_manual_2017.pdf'); });

Route::get('buddy-prirucka', function () {
    $fileName = 'buddy-prirucka-zs-19-20.pdf';
    return response()
        ->file("files/${fileName}", [
            'Content-Disposition' => "inline; filename=\"${fileName}\"",
        ]);
})
->name('buddy-prirucka');

Route::group(['namespace' => 'Web', 'prefix' => ''], function()
{
    Route::get('/', 'WebController@showHomePage');
    Route::get('/about-us', function() { return view('web.about'); });
    Route::get('/buddy-program', function() { return view('web.buddy-program'); });
    Route::get('/activities', 'WebController@showActivitesPage');
        Route::get('/activities/language-programs', 'WebController@showLanguagesPage');
        Route::get('/activities/sports', 'WebController@showSportsPage');
        Route::get('/activities/integreat', 'WebController@showInteGreatPage');
        Route::get('/activities/trips', 'WebController@showTripsPage');
    Route::get('/contact', 'WebController@showContacts');
    Route::get('/calendar', 'WebController@showCalendar');
    Route::get('/buddy', function () { return view('web.buddy'); });
    // Global IP when it is plugged in its public port -- not working now
    //Route::get('/nas', function () { return redirect('https://147.32.97.62:5001'); })->name('nas');
    // Local IP when it is plugged in the router -- works only in ISC Point
    //Route::get('/nas', function () { return redirect('https://192.168.0.102:5001'); })->name('nas');
    // Proxy using DDNS (and VPN?) -- should work always
    Route::get('/nas', function () { return redirect('http://quickconnect.to/ISCCTU'); })->name('nas');

    Route::post('/voting/process', 'VotingController@processVoting');
    Route::get('/voting/results', 'VotingController@showResults')->middleware(['checkpartak', 'auth']);
    Route::get('/voting/thank-you', 'VotingController@showThankYou');
    Route::get('/voting/{hash}', 'VotingController@showVotingForm');
    Route::get('/voting-test', 'VotingController@showTestEmail');

    Route::get('/volba', 'WebController@redirectToElectionStream');
    Route::get('/president', function() {
        return redirect(url('/volba'), 301);
    });
    Route::get('/volbapresidenta', function() {
      return redirect(url('/volba'), 301);
    });
    Route::get('/volba-presidenta', function() {
        return redirect(url('/volba'), 301);
    });
});

// Survival Guide
Route::group(['namespace' => 'Guide', 'prefix' => 'guide'], function() {
    Route::get('/', 'PageController@showPage')->name('guide');

    /*
     * Redirect from the old Survival guide URLs
     */
    Route::get('/sg.php', function () {
        $page = Request::get('page');
        return redirect(route('guide-page', ['page' => $page]), 301);
    });

    Route::get('/{page}', 'PageController@showPage')->name('guide-page');
});
//Restart password from old web
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');

Route::group(['namespace' => 'Exchange', 'prefix' => 'FlagParade'], function()
{
    Route::get('/{hash}', 'ProfileController@showFlagParade');
    Route::post('/{hash}', 'ProfileController@singUpFlagParade');
    Route::post('/{hash}/delete', 'ProfileController@deleteFlagParade');
});

Route::group(['namespace' => 'Czech', 'prefix' => 'czech'], function()
{
    Route::get('/', 'WebController@showHomePage');
    Route::get('/about-us', 'WebController@showAboutUsPage');
    Route::get('/calendar', 'WebController@showCalendarPage');
    Route::get('/activities', 'WebController@showActivitiesPage');
    Route::get('/contacts', 'WebController@showContactsPage');
}
);
