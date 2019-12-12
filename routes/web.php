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

Route::middleware(['auth'])->group(function () {

    Route::get('/', 'CardController@index');
    Route::get('/home', 'CardController@index')->name('home');

    Route::get('/cards/vote/{card}', 'VoteController@voteCard')->name('voteCard');
    Route::resource('cards', 'CardController');
    Route::get('/cards/{card_id}/link', 'CardController@linkCard')->name('link');
    Route::get('/cards/{card}/{cardOrigin}/link', 'CardController@linkToAnotherCard')->name('linktoanother');
    Route::get('/cards/{card_id}/linkList', 'CardController@linkList');
    Route::get('/cards/{card_id}/createAndLink', 'CardController@createAndLink')->name('createAndLink');
    Route::get('/validatedCards','CardController@getValidatedCards')->name('validatedCard');


    Route::get('/mesFiches', 'MyCardController@index')->name('mesFiches');

    Route::get('/searchCard', 'HomeController@searchCard')->name('searchCard');

    Route::get('/searchByUser/{id}', 'CardController@getCardsByUser');

    Route::post('/checkVedette', 'BasicDataController@checkVedette')->name('cards.checkvedette');
    Route::get('/modifyProfile', 'HomeController@modifyProfile')->name('Modifier son profil')->middleware('auth');
    Route::post('/modifyMail', 'UserController@modifyMail')->name('modifyMail')->middleware('auth');
    Route::post('/modifyLanguages', 'UserController@modifyLanguages')->name('modifyLanguages')->middleware('auth');
    Route::post('/modifyPassword', 'UserController@modifyPassword')->name('modifyPassword')->middleware('auth');
    /**
     * Route to get the view to search all cards from a user.
     */
    Route::get('/searchByUser', function () {
        return view('searchByAuthor', array("authors" => User::all()));
    })->name('searchByUser');
    Route::middleware(['admin'])->group(function () {

        Route::post('/cards/{id}/removeValidation', 'CardController@removeValidation')->name('cards.removeValidation');

        Route::get('/users', 'HomeController@indexUsers')->name('ListingUsers');

        Route::post('updateRole', 'UserController@updateRole')->name('admin.updateRole');

        Route::get('/addbasicdata', 'LanguageController@index')->name('basicData');

    });
});
