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

use App\Http\Controllers\CardController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/searchCard/{nameTitle}', 'CardController@getCardsBasedOnName');
Route::get('/searchCard' , 'HomeController@searchCard');
//Route::get('/searchCard', 'HomeController@getSearchView' );
