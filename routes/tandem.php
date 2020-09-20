<?php

Route::get('', 'TandemController@index')->name('index');

Route::middleware('auth:tandem')->group(function () {
    Route::get('main', 'TandemController@main')->name('main');
    Route::get('profile/{tandemUser}', 'TandemController@profile')->name('profile');
    Route::get('my-profile', 'TandemProfileController@edit')->name('my-profile');
    Route::patch('my-profile', 'TandemProfileController@update');
    Route::delete('my-profile', 'TandemProfileController@delete');
});

Route::get('login', 'Auth\\TandemLoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\\TandemLoginController@login');
Route::post('logout', 'Auth\\TandemLoginController@logout')->name('logout');

Route::get('register', 'Auth\\TandemRegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\\TandemRegisterController@register');

Route::get('password/reset', 'Auth\\TandemForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\\TandemForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('password/reset/{token}', 'Auth\\TandemResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\\TandemResetPasswordController@reset');

Route::get('password/change', 'Auth\\TandemChangePasswordController@showChangePasswordForm')->name('password.change');
Route::post('password/change', 'Auth\\TandemChangePasswordController@changePassword');

Route::get('change-language', 'TandemController@changeLanguage')->name('change-language');
