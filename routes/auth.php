<?php
/**
 * Routes for authentication
 * Namespace: Auth
 * Middleware:
 * Prefix: user
 */

    Route::get('/', 'LoginController@showLoginForm')->name('login');
    Route::post('/', 'LoginController@login');
    Route::get('/logout', 'LoginController@logout')->name('logout');

    Route::get('/register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'RegisterController@register');
    Route::post('/register-check', 'RegisterController@registerCheck')->name('register-check');

    Route::get('/profile', 'ProfileController@showProfileForm')->name('auth.profile.edit');
    Route::patch('/profile', 'ProfileController@updateProfile')->name('auth.profile.update');
    Route::post('/profile/skip', 'ProfileController@skipToVerification')->name('auth.profile.skip');

    Route::get('/verify', 'ProfileController@showVerificationForm')->name('auth.verification.request');
    Route::post('/verify', 'ProfileController@processVerificationForm')->name('auth.verification.email');
    Route::get('/verify/{hash}', 'ProfileController@verifyBuddy')->name('auth.verification.verify');
    Route::post('/noemail', 'ProfileController@processNoEmail')->name('auth.verification.motivation');
    Route::get('/thankyou', 'ProfileController@showThanks')->name('auth.verification.verified');

Route::middleware('guest')->group(function() {
    Route::get('password', 'ForgotPasswordController@showLinkRequestForm')
      ->name('auth.password-reset-form');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
});
