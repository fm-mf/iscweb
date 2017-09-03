<?php
/**
 * Routes for SAF
 * Namespace: Saf
 * Prefix: scvutdosveta
 */

Route::get('/', 'SafController@showIndex');
Route::get('/{partnerUrl}', 'SafController@showPartner');