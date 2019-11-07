<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/mesFiches', 'MyCardController@index')->name('mesFiches')->middleware('auth');

// Cards shouldn't be accessible directly from the web
// and should only be called trough a view
// If you still want to access the cards for testing purposes i.e
// then uncomment the next line
// TODO
// This should ideally be removed
//Route::resource('cards', 'CardController');
