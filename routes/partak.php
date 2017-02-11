<?php
/**
 * Created by PhpStorm.
 * User: speedy
 * Date: 5.2.17
 * Time: 8:59
 */

Route::group(['middleware' => ['checkpartak', 'auth'], 'namespace' => 'Partak', 'prefix' => 'partak'], function()
{
    Route::get('/', 'DashboardController@index');
    Route::get('/users/roles', 'RolesController@showDashboard');
    Route::get('/users/roles/remove/{id_user}/{id_role}', 'RolesController@removeRole');

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

    Route::get('/trips', 'EventController@showDashboard');
    Route::get('/trips/detail/{id}', 'EventController@showDetail');
    Route::get('/trips/detail/{id_event}/add/{id_part}', 'EventController@addToEvent');
    Route::get('/trips/{id_event}/remove/{id_part}', 'EventController@removeFromEvent');
    Route::get('/trips/edit/{id_event}', 'EventController@showEditForm')->name('trips.edit');
    Route::patch('/trips/edit/{id_event}', 'EventController@updateEditForm');
    Route::get('/trips/create', 'EventController@showCreateForm');
    Route::patch('/trips/create', 'EventController@submiteCreateForm');
    Route::get('/trips/delete/{id_trip}', 'EventController@deleteEvent');

    Route::get('/users/office-registration', 'OfficeRegistrationController@showOfficeRegistrationDashboard');
    Route::get('/users/office-registration/registration/{id}', 'OfficeRegistrationController@showExchangeStudent');
    Route::get('/users/office-registration/register/{id}', 'OfficeRegistrationController@esnRegistration');
    Route::get('/users/office-registration/create', 'OfficeRegistrationController@showCreateExStudent');
    Route::patch('/users/office-registration/create', 'OfficeRegistrationController@createExStudent');

    Route::get('/users/preregistrations', 'OfficeRegistrationController@showPreregistrations');
    Route::get('/users/preregistrations/{id}', 'OfficeRegistrationController@showPreregistrations');
});

