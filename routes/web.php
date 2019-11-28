<?php

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**
 * Routes for logging in / out
 */
Auth::routes();

/**
 * All route that need login
 */
Route::middleware(['auth'])->group(function() {
	/**
	 * Home page / index / dashboard
	 */
	Route::get('/', 'HomeController@index')->name('root');
	Route::get('/home', 'HomeController@index')->name('home');
	
	/**
	 * Route to display all cards by all users
	 */
	Route::get('/myCards', 'MyCardController@index')->name('myCards');
	
	/**
	 * Route to manage cards
	 */
	Route::resource('cards', 'CardController');
	
	/**
	 * Route to search all cards from a user
	 */
	Route::get('/searchCardByAuthor', function () {
		return view('searchCardByAuthor', [
			'authors' => User::all(),
		]);
	})->name('searchCardByAuthor');
	
	/**
	 * Route to add a new domain / subdomain / language
	 */
	Route::get('/addBasicData', function() {
		return view('addBasicData');
	})->name('addBasicData');
	
	/**
	 * Route to see all users and their role
	 */
	Route::get('/allUsers', 'HomeController@indexAllUsers')->name('allUsers');
	
	/**
	 * Routes to import new languages
	 */
	Route::get('/importLanguages', 'LanguageController@importView')->name('importLanguages');
});
