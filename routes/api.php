<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('addlanguage/{name}/code/{iso}/issigned/{issigned}', 'BasicDataController@addLanguage');

Route::get('adddomain/{name}', 'BasicDataController@addDomain');

Route::get('addsubdomain/{name}', 'BasicDataController@addSubdomain');

/**
 * Route to return all cards from an user in JSON
 * @param id The user id
 */
Route::get('getAllCardsFromUsers/{id}', 'CardController@getCardsByUser');
