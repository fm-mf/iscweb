<?php
/**
 * Routes for SAF
 * Namespace: Saf
 * Prefix: scvutdosveta
 */

Route::get('/', 'SafController@showIndex');
Route::get('/athens', 'SafController@showPage');
Route::get('/{partnerUrl}', 'SafController@showPartner');