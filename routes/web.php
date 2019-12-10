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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth'])->group(function() {

	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/cards/vote/{card}','VoteController@voteCard')->name('voteCard');
	Route::resource('cards', 'CardController');
	Route::get('/cards/{card_id}/link','CardController@linkCard')->name('link');
	Route::get('/cards/{card}/{cardOrigin}/link','cardController@linkToAnotherCard');
	Route::get('/cards/{card}/{cardOrigin}/link','cardController@linkToAnotherCard');
	Route::get('/cards/{card_id}/linkList', 'CardController@linkList');

	Route::get('/mesFiches', 'MyCardController@index')->name('mesFiches');

	Route::get('/searchCard' , 'HomeController@searchCard')->name('searchCard');

	Route::get('/searchByUser/{id}', 'CardController@getCardsByUser');

	Route::middleware(['admin'])->group(function() {

        Route::post('/cards/{id}/removeValidation', 'CardController@removeValidation')->name('cards.removeValidation');

        Route::get('/users','HomeController@indexUsers')->name('ListingUsers');
		
		Route::post('updateRole','UserController@updateRole')->name('admin.updateRole');
	});

});


/**
 * Route to get the view to search all cards from a user.
 */
Route::get('/searchByUser', function () {
    return view('searchByAuthor', array("authors" => User::all()));
})->name('searchByUser');

// /**
//  * Return the view to display one card
//  */
// Route::get("/card/{id}", 'CardController@showCard');

Route::get('/addLanguage','LanguageController@importView');

Route::get('/addbasicdata', 'LanguageController@index')->name('basicData');
