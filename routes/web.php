<?php

	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Route;

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
		Route::get('/',
			'HomeController@index')->name('root');
		Route::get('/home',
			'HomeController@index')->name('home');

		/**
		 * Route to manage cards
		 */
		Route::resource('cards',
			'CardController');

		/**
		 * Route to display all the cards of the logged in user
		 */
		Route::get('/myCards',
			'CardController@myCards')->name('myCards');

		/**
		 * Route to search a card (by heading / language)
		 */
		Route::get('/searchCard',
			'SearchController@searchCardView')->name('searchCard');

		/**
		 * All the routes only available to moderators and above
		 */
		Route::middleware(['moderator'])->group(function() {

			/**
			 * Route to search all cards from a user
			 */
			Route::get('/searchCardByAuthor',
				'SearchController@searchCardByAuthorView')->name('searchCardByAuthor');

			Route::middleware(['administrator'])->group(function() {

				/**
				 * Route to see all users and their role
				 */
				Route::get('/manageRoles',
					'UserController@manageRoles')->name('manageRoles');

				/**
				 * Route to add a new domain / subdomain / language
				 */
				Route::get('/addBasicData',
					'LanguageController@index')->name('addBasicData');

				/**
				 * Routes to import new languages
				 */
				Route::get('/importLanguages',
					'LanguageController@importView')->name('importLanguages');
			});
		});
	});
