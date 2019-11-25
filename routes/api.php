<?php

use Illuminate\Http\Request;

/**
 * All api routes should use the 'auth' middleware
 * So only logged users can access the api
 */
Route::middleware(['auth'])->group(function() {
});

/**
 * Returns the user logged in
 */
Route::get('/user', function(Request $request) {
	return $request->user();
});

Route::post('/updateRole', function(Request $request) {
	return "UserId : ". $request->userId . " : remplacer en une methode post";
});

/**
 * Route that returns all cards from a user in JSON format
 * @param id The user id
 */
Route::get('/getAllCardsFromUser/{id}', 'CardController@getCardsByUser')->name('getAllCardsFromUser');

/**
 * Route to add a new domain / subdoamin / language
 * @param name the name of the new subdomain
 */
Route::post('/addSubdomain/{name}', 'BasicDataController@addSubdomain')->name('addSubdomains');

/**
 * Route to import
 */
Route::post('/importLanguages', 'LanguageController@import')->name('importLanguages');

/**
 * Route to link cards
 * @param cardOrigin the origin card
 * @param cardLinked the card linked
 */
Route::get('/cards/{cardOrigin}/{cardLinked}/link', 'CardController@linkCard')->name('link');
