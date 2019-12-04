<?php

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Enums\Language;

/**
 * Routes for logging in / out
 */
Auth::routes();

/**
 * All route that need to be logged in
 */
Route::middleware(['auth'])->group(function() {
	/**
	 * Home page / index / dashboard
	 */
	Route::get('/', 'HomeController@index')->name('root');
	Route::get('/home', 'HomeController@index')->name('home');
	
	/**
	 * Route to manage cards
	 */
	Route::resource('cards', 'CardController');

	/**
	 * Route to display all the cards of the logged in user
	 */
	Route::get('/myCards', 'CardController@getMyCards')->name('myCards');
	
	/**
	 * Route to search a card (by heading / language)
	 */
	Route::get('/searchCard', 'SearchController@searchCardView')->name('searchCard');

	/**
	 * Route to search all cards from a user
	 */
	Route::get('/searchCardByAuthor', 'SearchController@searchCardByAuthorView')->name('searchCardByAuthor');
	
	/**
	 * Route to see all users and their role
	 */
	Route::get('/allUsers', 'UserController@allUsers')->name('allUsers');
	
	/**
	 * Route to add a new domain / subdomain / language
	 */
	Route::get('/addBasicData', 'LanguageController@index')->name('addBasicData');
	
	/**
	 * Routes to import new languages
	 */
	Route::get('/importLanguages', 'LanguageController@importView')->name('importLanguages');
});
