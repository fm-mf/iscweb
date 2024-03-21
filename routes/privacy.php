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
Route::get('/agreements-cs', 'PrivacyController@showAgreementCS')->name('privacy.agreement-cs');
Route::post('/partak', 'PrivacyController@privacyPartak')->name('privacy.partak')->middleware('auth');
Route::post('/buddy', 'PrivacyController@privacyBuddy')->name('privacy.buddy')->middleware('auth');
