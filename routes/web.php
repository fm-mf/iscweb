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
   //return redirect('https://goo.gl/forms/4VyVa30v0estkh293');
    return redirect('https://goo.gl/forms/BW8h8dEB58xdcqk03');
});


Route::get('buddy-prirucka', function () { return response()->file('files/buddy_prirucka_fall2018_pro_web.pdf'); });
//redirect from old web
Route::get('/buddy/files/buddy_prirucka_fall2018_pro_web.pdf', function () { return redirect(url('buddy-prirucka')); });

Route::group(['namespace' => 'Web', 'prefix' => ''], function()
{
    Route::get('/', 'WebController@showHomePage');
    Route::get('/about-us', function() { return view('web.about'); });
    Route::get('/buddy-program', function() { return view('web.buddy-program'); });
    Route::get('/activities', 'WebController@showActivitesPage');
        Route::get('/activities/language-programs', 'WebController@showLanguagesPage');
        Route::get('/activities/sports', 'WebController@showSportsPage');
        Route::get('/activities/integreat', 'WebController@showInteGreatPage');
        Route::get('/activities/trips', function() { return view('web.activities.trips'); });
    Route::get('/contact', 'WebController@showContacts');
    Route::get('/calendar', 'WebController@showCalendar');
    Route::get('/buddy', function () { return view('web.buddy'); });
    Route::get('/nas', function () { return redirect('https://147.32.97.62:5001'); })->name('nas');

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

