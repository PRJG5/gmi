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

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/searchCard' , 'HomeController@searchCard')->middleware('auth');
Route::get('/mesFiches', 'MyCardController@index')->name('mesFiches')->middleware('auth');
Route::get('/users','HomeController@indexUsers')->name('ListingUsers')->middleware('auth');


/**
 * Cards shouldn't be accessible directly from the web
 * and should only be called trough a view
 * If you still want to access the cards for testing purposes i.e
 * then uncomment the next line
 * // TODO
 * This should ideally be removed
 * @author 44422
 */
Route::resource('cards', 'CardController')->middleware('auth');

/**
 * Route to display a page to search all cards from an user
 */
Route::name('admin.')->group(function () {
    Route::post('updateRole','UserController@updateRole')->name('updateRole');
});

/**
 * Route to get the view to search all cards from a user.
 */
Route::get('/searchByUser', function () {
    return view('searchByAuthor', array("authors" => User::all()));
})->middleware('auth');

/**
 * Return a part of HTML to display all cards from the user
 * @param id the id of the user 
 */
Route::get('/searchByUser/{id}', 'CardController@getCardsByUser')->middleware('auth');

/**
 * Return the view to display one card
 */
Route::get("/card/{id}", 'CardController@showCard')->middleware('auth');

/**
 * Route to return all cards from an user in JSON
 * @param id The user id
 */
Route::get('api/getAllCardsFromUsers/{id}', 'CardController@getCardsByUser')->middleware('auth');

Route::get('cards/{cardOrigin}/{cardLinked}/link','CardController@linkCard')->name('link')->middleware('auth');

Route::get('api/addsubdomain/{name}', 'BasicDataController@addSubdomain')->middleware('auth');
Route::get('api/addlanguage/{name}/code/{iso}', 'BasicDataController@addLanguage')->middleware('auth');
Route::get('api/adddomain/{name}', 'BasicDataController@addDomain')->middleware('auth');
Route::get('/addbasicdata', 'LanguageController@index')->name('basicData')->middleware('auth');
Route::get('cards/vote/{card}','VoteController@voteCard')->name('voteCard')->middleware('auth');
?>

