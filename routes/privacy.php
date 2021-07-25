<?php

/**
 * Routes for Privacy
 * Namespace: Privacy
 * Middleware:
 * Prefix: privacy
 */

Route::get('/', 'PrivacyController@showTree');
Route::get('/notice', 'PrivacyController@showPrivacyNotice')->name('privacy.notice');
Route::get('/policy', 'PrivacyController@showPrivacyPolicy')->name('privacy.policy');
Route::get('/agreements-cs', 'PrivacyController@showAgreementCS');
Route::post('/partak', 'PrivacyController@privacyPartak')->middleware('auth');
Route::post('/buddy', 'PrivacyController@privacyBuddy')->middleware('auth');
