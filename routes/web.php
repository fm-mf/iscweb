<?php

use Illuminate\Support\Facades\Route;

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

use Symfony\Component\HttpFoundation\Response;

Route::get('/event/{id}/cancel/{hash}', 'Exchange\ReservationController@showForm')->name('event.cancel');
Route::get('/event/{id}', 'Exchange\ReservationController@showForm')->name('event.show');

Route::resource('exchange', 'Exchange\ProfileController', [
    'parameters' => ['exchange' => 'student'],
])->only(['show', 'update']);

Route::get('/stats', 'Stats\StatsController@showStatistics');
Route::get('/owstats', 'Stats\StatsController@showOwTripsStatistics');

Route::get('/visa', function() {
   //return redirect('https://goo.gl/forms/4VyVa30v0estkh293');
    return redirect('https://docs.google.com/forms/d/1zys0lGLZ2WlwDeo4yZObTTEjElrudjQs3UDoBCr1-MI/edit');
});


Route::get('kos-manual', function () { return response()->file('files/KOS_manual_2017.pdf'); });

Route::get('buddy-prirucka', function () {
    $fileName = 'buddy_prirucka-ls_2022_2023.pdf';
    return response()
        ->file("files/${fileName}", [
            'Content-Disposition' => "inline; filename=\"${fileName}\"",
        ]);
})
->name('buddy-handbook-cs');

Route::group(['namespace' => 'Web', 'prefix' => ''], function()
{
    Route::get('/', 'WebController@showLangSelection')->name('web.lang-select');
    Route::get('/home', 'WebController@showHomePage')->name('web.index');
    Route::get('/about-us', function() { return view('web.about'); })->name('web.about');
    Route::get('/buddy-program', function() { return view('web.buddy-program'); })->name('web.buddy-program');
    Route::get('/activities', 'WebController@showActivitesPage')->name('web.activities.index');
        Route::get('/activities/language-programs', 'WebController@showLanguagesPage')->name('web.activities.languages');
        Route::get('/activities/sports', 'WebController@showSportsPage')->name('web.activities.sports');
        Route::get('/activities/integreat', 'WebController@showInteGreatPage')->name('web.activities.integreat');
        Route::get('/activities/trips', 'WebController@showTripsPage')->name('web.activities.trips');
    Route::get('/contact', 'WebController@showContacts')->name('web.contacts');
    Route::get('/calendar', 'WebController@showCalendar')->name('web.calendar');
    Route::get('/faq', 'WebController@showFaqPage')->name('web.faq');
    Route::get('/buddy', function() { return redirect(route('czech.index'), 301); });
    // Global IP when it is plugged in its public port -- not working now
    //Route::get('/nas', function () { return redirect('https://147.32.97.62:5001'); })->name('nas');
    // Local IP when it is plugged in the router -- works only in ISC Point
    //Route::get('/nas', function () { return redirect('https://192.168.0.102:5001'); })->name('nas');
    // Proxy using DDNS (and VPN?) -- should work always
    Route::get('/nas', function () { return redirect('http://quickconnect.to/ISCCTU'); })->name('nas');

    Route::get('/wiki')->name('wiki');

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
    Route::get('/coronavirus', 'WebController@showCoronavirusPage')->name('coronavirus');
});

// Survival Guide
Route::group(['namespace' => 'Guide', 'prefix' => 'guide'], function() {
    Route::get('/', 'PageController@showPage')->name('guide');

    /*
     * Redirect from the old Survival guide URLs
     */
    Route::get('/sg.php', function () {
        $page = request()->query('page');
        if (empty($page)) {
            return redirect()->route('guide', null, Response::HTTP_MOVED_PERMANENTLY);
        }
        return redirect()->route('guide-page', ['page' => $page], Response::HTTP_MOVED_PERMANENTLY);
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

Route::prefix('czech')->namespace('Czech')->name('czech.')->group(function() {
    Route::get('/', 'WebController@showHomePage')->name('index');
    Route::get('/about-us', 'WebController@showAboutUsPage')->name('about');
    Route::get('/calendar', 'WebController@showCalendarPage')->name('calendar');
    Route::prefix('activities')->name('activities.')->group(function() {
        Route::get('/', 'WebController@showActivitiesIndexPage')->name('index');
        Route::get('/languages', 'WebController@showActivitiesLanguagesPage')->name('languages');
        Route::get('/trips', 'WebController@showActivitiesTripsPage')->name('trips');
        Route::get('/inteGREAT', 'WebController@showActivitiesInteGreatPage')->name('inteGREAT');
    });
    Route::get('/buddy-program', 'WebController@showBuddyProgramPage')->name('buddy-program');
    Route::get('/faq', 'WebController@showFaqPage')->name('faq');
    Route::get('/contacts', 'WebController@showContactsPage')->name('contacts');
});

Route::prefix('alumni')->namespace('Alumni')->name('alumni.')->group(function() {
    Route::get('/', 'AlumniController@index')->name('index');
    Route::resource('/newsletters', 'AlumniNewsletterController', ['except' => ['show']]);
    Route::get('/newsletters/deleted', 'AlumniNewsletterController@showDeleted')->name('newsletters.deleted');
    Route::patch('/newsletters/{id}/restore', 'AlumniNewsletterController@restore')->name('newsletters.restore');
});

Route::prefix('api')->namespace('Api')->name('api.')->group(function() {
    Route::post('/avatar', 'AvatarController@upload');
    Route::post('/load', 'ApiController@load')->middleware('auth', 'checkbuddy');

    Route::post('/autocomplete/exchange-students', 'AutocompleteController@exchangeStudents')->middleware('auth', 'checkpartak');
    Route::post('/autocomplete/buddies', 'AutocompleteController@buddies')->middleware('auth', 'checkpartak');
    Route::post('/liststudents', 'ApiController@load')->middleware('auth', 'checkbuddy');
    Route::get('/filter-options', 'ApiController@loadFilterOptions')->middleware('auth', 'checkbuddy');

    Route::get('/preregister', 'ApiController@loadPreregister')->middleware('auth', 'checkpartak')->name('preregister');
    Route::patch('/preregister/{exchange_student}', 'ApiController@preregister')->middleware('auth', 'checkpartak');
});

Route::get('change-language', 'Web\WebController@changeLanguage')->name('change-language');

Route::group(
    [
        'prefix' => 'auth',
        'namespace' => 'Auth',
        'as' => 'auth.',
    ],
    function () {
        Route::get('{provider}', 'LoginController@redirectToProvider')->name('provider');
        Route::get('{provider}/callback', 'LoginController@handleProviderCallback')->name('provider.callback');
    }
);
