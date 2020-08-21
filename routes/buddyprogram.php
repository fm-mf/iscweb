<?php

/**
 * Created by PhpStorm.
 * User: speedy
 * Date: 5.2.17
 * Time: 9:03
 */

// Redirect legacy links
Route::get('/muj-buddy/register/update-exchange-profile/{hash}', function ($hash) {
    return redirect('/exchange/' . $hash);
});

Route::get('/muj-buddy/register/buddy', function () {
    return redirect('/user/register');
});

Route::group(['middleware' => ['checkbuddy', 'auth'], 'namespace' => 'Buddyprogram', 'prefix' => 'muj-buddy'], function () {
    Route::get('/', 'ListingController@listExchangeStudents')->name('buddy-home');
    Route::get('/profile/{exchangeStudent}', 'StudentController@showProfile')->name('buddy-profile');
    Route::post('/become-buddy/{exchangeStudent}', 'StudentController@assignBuddy')->name('become-buddy');
    Route::get('/my-students', 'ListingController@listMyStudents')->name('buddy-my-students');
    Route::get('/my-profile', 'ProfileController@showProfile')->name('buddy-my-profile');
    Route::patch('/my-profile', 'ProfileController@updateProfile')->name('buddy-update-my-profile');
    Route::post('/change-password', 'ProfileController@changePassword')->name('buddy-password-change');

    Route::get('/list', function () {
        return redirect(route('buddy-home'), 301);
    });
    Route::get('/closed', function () {
        return redirect(route('buddy-home'), 301);
    });
});



Route::group(['namespace' => 'Exchange', 'prefix' => 'exchange'], function () {
    Route::get('/{hash}', 'ProfileController@showProfileForm');
    Route::patch('/', 'ProfileController@updateProfile');
});
