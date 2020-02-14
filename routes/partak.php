<?php

/**
 * Routes for PartakNet
 * Namespace: Partak
 * Middleware: checkpartak, auth
 * Prefix: partak
 */

Route::get('/', 'DashboardController@index')->name('index');
Route::get('/users/roles', 'RolesController@showDashboard')->name('roles');
Route::get('/users/partaks', 'RolesController@showPartaks')->name('users.partaks');
Route::get('/users/roles/remove/{id_user}/{id_role}', 'RolesController@removeRole');

Route::get('/users', 'DashboardController@users')->name('users');

Route::get('/users/buddies', 'BuddiesController@showBuddiesDashboard')->name('users.buddies');
Route::get('/users/buddies/{id}', 'BuddiesController@showBuddyDetail')->name('users.buddy');
Route::get('/users/buddies/{id_buddy}/remove/{id_exStudent}', 'BuddiesController@removeExStudentFromBuddy');
Route::get('/users/buddies/edit/{id}', 'BuddiesController@showEditFormBuddy');
Route::patch('/users/buddies/edit/{id}', 'BuddiesController@submitEditFormBuddy');

Route::get('/users/buddies/approve/{id}', 'BuddiesController@approveBuddy');
Route::get('/users/buddies/deny/{id}', 'BuddiesController@denyBuddy');
//Route::get('/mail', 'DashboardController@mail')->middleware('can:partaknet');

Route::get('/users/exchange-students', 'ExchangeStudentsController@showExchangeStudentDashboard')
    ->name('users.exchangeStudents');
Route::get('/users/exchange-students/{id_user}', 'ExchangeStudentsController@showDetailExchangeStudent')
    ->name('users.exchangeStudent');
Route::get('/users/exchange-students/edit/{id_user}', 'ExchangeStudentsController@showEditFormExchangeStudent')
    ->name('exStudent.edit');
Route::patch('/users/exchange-students/edit/{id}', 'ExchangeStudentsController@submitEditFormExStudent');

//Route::get('/users/office-registration', 'OfficeRegistrationControler@showOfficeRegistrationDashboard');
//Route::get('/users/office-registration/{id}', 'OfficeRegistrationControler@showExchangeStudent');
//Route::get('/users/office-registration/register/{id}', 'OfficeRegistrationControler@esnRegistration');

Route::get('/trips', 'DashboardController@trips')->name('trips');
Route::post('/trips/upload-option', 'TripController@uploadOptionImage');
Route::get('/trips/upcoming', 'TripController@showUpcoming')->name('trips.upcoming');
Route::get('/trips/mytrips', 'TripController@showMyTrips')->name('trips.my');
Route::get('/trips/detail/{id}', 'TripController@showDetail')->name('trips.detail');
Route::get('/trips/detail/{id}/pdf', 'TripController@showDetailPdf');
Route::get('/trips/detail/{id}/excel', 'TripController@showDetailExcel');
Route::get('/trips/detail/{id_event}/add/{id_part}', 'TripController@confirmAddParticipant');
Route::patch('/trips/detail/{id_event}/add/{id_part}', 'TripController@addParticipantToTrip');
Route::get('/trips/{id_event}/remove/{id_part}', 'TripController@removeParticipantFromTrip');
Route::get('/trips/{id_event}/cancel/{id_part}', 'TripController@removeReservationFromTrip');
Route::get('/trips/edit/{id_trip}', 'TripController@showEditForm')->name('trips.edit');
Route::patch('/trips/edit/{id_trip}', 'TripController@submitEditForm');
Route::get('/trips/create', 'TripController@showCreateForm')->name('trips.create');
Route::patch('/trips/create', 'TripController@submitCreateForm');
Route::get('/trips/delete/{id_trip}', 'TripController@deleteTrip');
Route::get('/trips/{id_event}/payment/{id_payment}', 'TripController@showPaymentDetail');

Route::get('/events', 'EventController@showDashboard')->name('events');
Route::get('/events/edit/{id_event}', 'EventController@showEditForm')->name('events.edit');
Route::patch('/events/edit/{id_event}', 'EventController@submmitEditForm');
Route::get('/events/create', 'EventController@showCreateForm')->name('events.create');
Route::get('/events/create/integreat', 'EventController@showCreateForm')->name('events.integreat');
Route::get('/events/create/languages', 'EventController@showCreateForm')->name('events.languages');
Route::patch('/events/create', 'EventController@submitCreateForm');
Route::get('/events/delete/{id_event}', 'EventController@deleteEvent');

Route::get('/users/office-registration', 'OfficeRegistrationController@showOfficeRegistrationDashboard')
    ->name('users.registration');
Route::get('/users/office-registration/registration/{id}', 'OfficeRegistrationController@showExchangeStudent')
    ->name('users.registration.user');
Route::get('/users/office-registration/register/{id}/{phone}/{esnCard}', 'OfficeRegistrationController@esnRegistrationNotPreregistered');
Route::get('/users/office-registration/register/{id}', 'OfficeRegistrationController@esnRegistration');
Route::get('/users/office-registration/create', 'OfficeRegistrationController@showCreateExStudent');
Route::patch('/users/office-registration/create', 'OfficeRegistrationController@createExStudent');

Route::get('/users/preregistrations', 'OfficeRegistrationController@showPreregistrations')
    ->name('users.preregistrations');
Route::get('/users/preregistrations/{id}', 'OfficeRegistrationController@showPreregistrations')
    ->name('users.preregistration');

Route::get('/settings', 'SettingsController@showSettings')->name('settings');
Route::patch('/settings', 'SettingsController@submitSettings');
Route::get('/openinghours', 'SettingsController@getOpeningHours');
Route::get('/logs', 'LogsController@index')->name('logs');

Route::prefix('/settings/contacts')
    ->name('settings.contacts.')
    ->group(function () {
        Route::get('/', 'ContactsSettingsController@index')->name('index');
        Route::get('/data', 'ContactsSettingsController@data')->name('data');
        Route::get('/create', 'ContactsSettingsController@create')->name('create');
        Route::post('/', 'ContactsSettingsController@store')->name('store');
        Route::get('/{contact}/edit', 'ContactsSettingsController@edit')->name('edit');
        Route::patch('/{contact}', 'ContactsSettingsController@update')->name('update');
        Route::put('/{contact}', 'ContactsSettingsController@update')->name('update');
        Route::post('/{contact}/move', 'ContactsSettingsController@move')->name('move');
        Route::delete('/{contact}', 'ContactsSettingsController@destroy')->name('destroy');
    });

Route::prefix('/stats')
    ->name('stats.')
    ->group(function () {
        Route::get('/', 'StatsController@showIndex')->name('index');

        Route::get('/arrivals', 'StatsController@showIndex')->name('arrivals');
        Route::get('/buddies', 'StatsController@showIndex')->name('buddies');
        Route::get('/students', 'StatsController@showIndex')->name('students');
        Route::get('/exports', 'StatsController@showIndex')->name('exports');
        Route::get('/history', 'StatsController@showIndex')->name('history');

        Route::prefix('/api')
            ->name('api.')
            ->group(function () {
                Route::get('/semesters', 'StatsController@getSemesters')
                    ->name('semesters');
                Route::get('/active-buddies', 'StatsController@getActiveBuddies')
                    ->name('active-buddies');

                Route::prefix('/semester/{semester}')
                    ->group(function () {
                        Route::get('/student-counts', 'StatsController@getStudentCounts')
                            ->name('student-counts');
                        Route::get('/buddies', 'StatsController@getBuddies')
                            ->name('buddies');
                        Route::get('/arrivals', 'StatsController@getArrivals')
                            ->name('arrivals');
                        Route::get('/students', 'StatsController@getStudents')
                            ->name('students');
                    });
            });

        Route::prefix('/export')
            ->name('export.')
            ->group(function () {
                Route::get('/active-buddies', 'StatsController@exportActiveBuddies')
                    ->name('active-buddies');

                Route::prefix('/semester/{semester}')
                    ->group(function () {
                        Route::get('/culture-evening-candidates', 'StatsController@exportCultureEveningCandidates')
                            ->name('culture-evening-candidates');
                    });
            });
    });
