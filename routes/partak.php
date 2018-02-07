<?php
/**
 * Routes for PartakNet
 * Namespace: Partak
 * Middleware: checkpartak, auth
 * Prefix: partak
 */


    Route::get('/', 'DashboardController@index');
    Route::get('/users/roles', 'RolesController@showDashboard');
    Route::get('/users/partaks', 'RolesController@showPartaks');
    Route::get('/users/roles/remove/{id_user}/{id_role}', 'RolesController@removeRole');

    Route::get('/users', 'DashboardController@users');

    Route::get('/users/buddies', 'BuddiesController@showBuddiesDashboard');
    Route::get('/users/buddies/{id}', 'BuddiesController@showBuddyDetail');
    Route::get('/users/buddies/{id_buddy}/remove/{id_exStudent}', 'BuddiesController@removeExStudentFromBuddy');
    Route::get('/users/buddies/edit/{id}', 'BuddiesController@showEditFormBuddy');
    Route::patch('/users/buddies/edit/{id}', 'BuddiesController@submitEditFormBuddy');

    Route::get('/users/buddies/approve/{id}', 'BuddiesController@approveBuddy');
    Route::get('/users/buddies/deny/{id}', 'BuddiesController@denyBuddy');
    //Route::get('/mail', 'DashboardController@mail')->middleware('can:partaknet');

    Route::get('/users/exchange-students', 'ExchangeStudentsController@showExchangeStudentDashboard');
    Route::get('/users/exchange-students/{id_user}', 'ExchangeStudentsController@showDetailExchangeStudent');
    Route::get('/users/exchange-students/edit/{id_user}', 'ExchangeStudentsController@showEditFormExchangeStudent')->name('exStudent.edit');
    Route::patch('/users/exchange-students/edit/{id}', 'ExchangeStudentsController@submitEditFormExStudent');

    //Route::get('/users/office-registration', 'OfficeRegistrationControler@showOfficeRegistrationDashboard');
    //Route::get('/users/office-registration/{id}', 'OfficeRegistrationControler@showExchangeStudent');
    //Route::get('/users/office-registration/register/{id}', 'OfficeRegistrationControler@esnRegistration');

    Route::get('/trips', 'DashboardController@trips');
    Route::get('/trips/upcoming', 'TripController@showUpcoming');
    Route::get('/trips/mytrips', 'TripController@showMyTrips');
    Route::get('/trips/detail/{id}', 'TripController@showDetail');
    Route::get('/trips/detail/{id}/pdf', 'TripController@showDetailPdf');
    Route::get('/trips/detail/{id}/excel', 'TripController@showDetailExcel');
    Route::get('/trips/detail/{id_event}/add/{id_part}', 'TripController@confirmAddParticipant');
    Route::patch('/trips/detail/{id_event}/add/{id_part}', 'TripController@addParticipantToTrip');
    Route::get('/trips/{id_event}/remove/{id_part}', 'TripController@removeParticipantFromTrip');
    Route::get('/trips/edit/{id_trip}', 'TripController@showEditForm')->name('trips.edit');
    Route::patch('/trips/edit/{id_trip}', 'TripController@submitEditForm');
    Route::get('/trips/create', 'TripController@showCreateForm');
    Route::patch('/trips/create', 'TripController@submitCreateForm');
    Route::get('/trips/delete/{id_trip}', 'TripController@deleteTrip');
    Route::get('/trips/{id_event}/payment/{id_payment}', 'TripController@showPaymentDetail');

    Route::get('/events', 'EventController@showDashboard');
    Route::get('/events/edit/{id_event}', 'EventController@showEditForm')->name('events.edit');
    Route::patch('/events/edit/{id_event}', 'EventController@submmitEditForm');
    Route::get('/events/create', 'EventController@showCreateForm');
    Route::get('/events/create/integreat', 'EventController@showCreateForm');
    Route::get('/events/create/languages', 'EventController@showCreateForm');
    Route::patch('/events/create', 'EventController@submitCreateForm');

    Route::get('/users/office-registration', 'OfficeRegistrationController@showOfficeRegistrationDashboard');
    Route::get('/users/office-registration/registration/{id}', 'OfficeRegistrationController@showExchangeStudent');
    Route::get('/users/office-registration/register/{id}/{phone}/{esnCard}', 'OfficeRegistrationController@esnRegistration');
    // Route::get('/users/office-registration/register/{id}', 'OfficeRegistrationController@esnRegistration');
    Route::get('/users/office-registration/create', 'OfficeRegistrationController@showCreateExStudent');
    Route::patch('/users/office-registration/create', 'OfficeRegistrationController@createExStudent');

    Route::get('/users/preregistrations', 'OfficeRegistrationController@showPreregistrations');
    Route::get('/users/preregistrations/{id}', 'OfficeRegistrationController@showPreregistrations');

    Route::get('/settings', 'SettingsController@showSettings');
    Route::patch('/settings', 'SettingsController@submitSettings');

