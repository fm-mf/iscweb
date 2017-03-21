<?php
/**
 * Routes for authentication
 * Namespace: Auth
 * Middleware:
 * Prefix: user
 */

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
