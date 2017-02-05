<?php
/**
 * Created by PhpStorm.
 * User: speedy
 * Date: 5.2.17
 * Time: 9:04
 */

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');


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

    Route::get('password', 'ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'ResetPasswordController@reset');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');
});
