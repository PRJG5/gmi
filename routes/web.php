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
use App\User;

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
Route::resource('cards', 'CardController');
/**
 * Route to display a page to search all cards from an user
 */
Route::get('/searchByUser', function () {
    return view('searchByAuthor', array("authors" => User::all()));
})->middleware('auth');
/**
 * Route to return all cards from an user in JSON
 * @param id The user id
 */
Route::get('api/getAllCardsFromUsers/{id}', 'CardController@getCardsByUser');

?>
