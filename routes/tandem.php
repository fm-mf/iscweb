<?php

Route::get('', 'TandemController@index')->name('index');

Route::middleware('auth:tandem')->group(function () {
    Route::get('main', 'TandemController@main')->name('main');
    Route::get('profile', 'TandemController@profile')->name('profile');
});

Route::get('login', 'Auth\\TandemLoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\\TandemLoginController@login');
Route::post('logout', 'Auth\\TandemLoginController@logout')->name('logout');

Route::get('register', 'Auth\\TandemRegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\\TandemRegisterController@register');

Route::get('change-language', 'TandemController@changeLanguage')->name('change-language');
