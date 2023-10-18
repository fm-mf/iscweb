<?php

/**
 * Routes for PartakNet
 * Namespace: Partak
 * Middleware: checkpartak, auth
 * Prefix: partak
 */

Route::get('/', 'DashboardController@index')->name('index');

Route::prefix('/users')
    ->name('users.')
    ->group(function () {
        Route::get('/roles', 'RolesController@showDashboard')->name('roles');
        Route::get('/roles/remove/{id_user}/{id_role}', 'RolesController@removeRole')->name('roles.remove');
        Route::get('/partaks', 'RolesController@showPartaks')->name('partaks');

        Route::resource('buddies', 'BuddiesController')->except(['create', 'store', 'destroy']);
        Route::patch('buddies/{buddy}/approval', 'BuddyApprovalController@update')->name('buddies.approval.update');
        Route::resource('buddies.exchange-students', 'BuddyExchangeStudentsController')->only(['destroy']);

        Route::get('/exchange-students', 'ExchangeStudentsController@showExchangeStudentDashboard')
            ->name('exchangeStudents');
        Route::get('/exchange-students/{id_user}', 'ExchangeStudentsController@showDetailExchangeStudent')
            ->name('exchangeStudent');
        Route::get('/exchange-students/edit/{id_user}', 'ExchangeStudentsController@showEditFormExchangeStudent')
            ->name('exStudent.edit');
        Route::patch('/exchange-students/edit/{id}', 'ExchangeStudentsController@submitEditFormExStudent')
            ->name('exStudent.doEdit');
        Route::post('/exchange-students/promote/{id_user}', 'ExchangeStudentsController@promoteExchangeStudent')
            ->name('exStudent.promote');
        Route::get('/exchange-students/promote/{id_user}/success', 'ExchangeStudentsController@showPromotedExchangeStudent')
            ->name('exStudent.promoteSuccess');

        Route::get('/office-registration', 'OfficeRegistrationController@showOfficeRegistrationDashboard')
            ->name('registration');
        Route::get('/office-registration/registration/{id}', 'OfficeRegistrationController@showExchangeStudent')
            ->name('registration.user');
        Route::post('/office-registration/register/{id}', 'OfficeRegistrationController@esnRegistration')
            ->name('registration.register');
        Route::get('/office-registration/create', 'OfficeRegistrationController@showCreateExStudent')
            ->name('registration.create');
        Route::patch('/office-registration/create', 'OfficeRegistrationController@createExStudent')
            ->name('registration.doCreate');

        Route::get('/preregistrations', 'OfficeRegistrationController@showPreregistrations')
            ->name('preregistrations');
        Route::get('/preregistrations/{id}', 'OfficeRegistrationController@showPreregistrations')
            ->name('preregistration');

        Route::get('/quarantined', 'QuarantinedController@list')->name('quarantined');
        Route::get('/quarantined/export', 'QuarantinedController@export')->name('quarantined.export');

        Route::get('/import', 'UsersImportController@index')->name('import.index');
        Route::post('/import', 'UsersImportController@store')->name('import.store');
    });

Route::prefix('/trips')
    ->name('trips.')
    ->group(function () {
        Route::get('/', 'TripController@list')->name('list');
        Route::post('/upload-option', 'TripController@uploadOptionImage')->name('uploadOption');
        Route::get('/upcoming', 'TripController@showUpcoming')->name('upcoming');
        Route::get('/mytrips', 'TripController@showMyTrips')->name('my');
        Route::get('/detail/{id}', 'TripController@showDetail')->name('detail');
        Route::get('/detail/{id}/pdf', 'TripController@showDetailPdf')->name('export.pdf');
        Route::get('/detail/{id}/excel', 'TripController@showDetailExcel')->name('export.excel');
        Route::get('/detail/{id_event}/add/{id_part}', 'TripController@confirmAddParticipant')->name('participant.add');
        Route::patch('/detail/{id_event}/add/{id_part}', 'TripController@addParticipantToTrip')
            ->name('participant.doAdd');
        Route::get('/{id_event}/remove/{id_part}', 'TripController@removeParticipantFromTrip')
            ->name('pariticpant.remove');
        Route::get('/{id_event}/cancel/{id_part}', 'TripController@removeReservationFromTrip')
            ->name('paritcipant.cancelReservation');
        Route::get('/edit/{id_trip}', 'TripController@showEditForm')->name('edit');
        Route::patch('/edit/{id_trip}', 'TripController@submitEditForm')->name('doEdit');
        Route::get('/create', 'TripController@showCreateForm')->name('create');
        Route::patch('/create', 'TripController@submitCreateForm')->name('doCreate');
        Route::get('/delete/{id_trip}', 'TripController@deleteTrip')->name('delete');
        Route::get('/{id_event}/payment/{id_payment}', 'TripController@showPaymentDetail')->name('pariticpant.detail');
    });


Route::get('/events/create/integreat', 'EventController@create')->name('events.create.integreat');
Route::get('/events/create/languages', 'EventController@create')->name('events.create.languages');
Route::post('/events/{event}/duplicate', 'EventController@duplicate')->name('events.duplicate');
Route::resource('/events', 'EventController')->except(['show']);

Route::prefix('/settings')
    ->name('settings.')
    ->group(function () {
        Route::get('/general', 'SettingsController@showSettings')->name('general');
        Route::patch('/general', 'SettingsController@submitSettings')->name('general.save');

        Route::get('/opening-hours', 'SettingsController@showOpeningHours')
            ->name('openingHours');
        Route::patch('/opening-hours', 'SettingsController@submitOpeningHours');

        Route::get('/coronavirus', 'SettingsController@showCoronavirus')
            ->name('coronavirus');
        Route::patch('/coronavirus', 'SettingsController@submitCoronavirus')
            ->name('coronavirus.save');

        Route::prefix('/contacts')
            ->name('contacts.')
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
    });

Route::get('/opening-hours', 'SettingsController@getOpeningHoursData');
Route::get('/logs', 'LogsController@index')->name('logs');

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

Route::resource('esn-card-labels', 'EsnCardLabelsController')
    ->only(['index', 'store']);

Route::resource('products', 'ProductsController');
Route::resource('products.sales', 'ProductSalesController')
    ->only(['create', 'store']);
