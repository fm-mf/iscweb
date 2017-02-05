<?php
/**
 * Created by PhpStorm.
 * User: speedy
 * Date: 5.2.17
 * Time: 9:03
 */

// Redirect legacy links
Route::get('/muj-buddy/register/update-exchange-profile/{hash}', function($hash) {
    return redirect('/exchange/' . $hash);
});

Route::get('/muj-buddy/register/buddy', function() {
    return redirect('/user/register');
});

Route::group(['middleware' => ['checkbuddy', 'auth'], 'namespace' => 'Buddyprogram', 'prefix' => 'muj-buddy'], function()
{
    Route::get('/', 'ListingController@listExchangeStudents');
    Route::get('/list', 'ListingController@listExchangeStudents');
    Route::get('/profile/{id}', 'StudentController@showProfile');
    Route::get('/become-buddy/{id}', 'StudentController@assignBuddy');
    Route::get('/my-students/', 'ListingController@listMyStudents');
    Route::get('/closed/', 'ListingController@showClosed');
});



Route::group(['namespace' => 'Exchange', 'prefix' => 'exchange'], function()
{
    Route::get('/{hash}', 'ProfileController@showProfileForm');
    Route::patch('/', 'ProfileController@updateProfile');
});
