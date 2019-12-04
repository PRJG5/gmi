<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/**
 * Updates the role of a user
 */
Route::put('/updateRole', 'UserController@updateRole')->name('updateRole');

/**
 * Route that returns all cards from a user in JSON format
 * @param int $id The user id
 */
Route::get('/getAllCardsFromUser/{id}', 'CardController@getAllCardsFromUser')->name('getAllCardsFromUser');

/**
 * Route to add a new domain
 * @param string $name the name of the new subdomain
 */
Route::post('/addSubdomain/{name}', 'BasicDataController@addSubdomain')->name('addSubdomains');

/**
 * Route to add a new language
 * @param string $name the name of the language
 * @param string $iso the iso code of the language
 */
Route::get('/addLanguage/{name}/code/{iso}', 'BasicDataController@addLanguage')->name('addLanguages');

/**
 * Route to import from Excel file
 */
Route::post('/importLanguages', 'LanguageController@import')->name('importLanguages');

/**
 * Route to link cards
 * @param int $cardOrigin the origin card
 * @param int $cardLinked the card linked
 */
Route::get('/cards/{cardOrigin}/{cardLinked}/link', 'CardController@linkCard')->name('link');

/**
 * Route to get the raw content of a card
 */
Route::get('/rawCard/{card}', 'CardController@getRawCard');

/**
 * Route to get the raw content of multiple cards
 * // TODO
 */
Route::get('/rawCards/{card}', 'CardController@getRawCards');
