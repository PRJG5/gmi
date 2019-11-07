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
use App\Enums\Language;
use Illuminate\Support\Facades\Auth;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/card/create', function () {
    // Use Auth::user() and not facory
    //$user = factory('App\User')->make();
    //factory('App\Card')->make() // not work in production
    $card = (object)array("card_id" => 1,"cardId" =>1, "heading" => "titre", "key" => "FRA","language_id"=> "FRA");
    $data = ['user' => Auth::user(), 'languages' => Language::getInstances(), 'editable' => True, 'card' => $card];
    return view('card/create',$data);
});

Route::post('/card/create/submit', 'CardController@store')->name('createCard');

Route::get('/card/{id}/edit', function ($id) {
    //  Use Card::find($id) and not factory when we have finish all test 
    $card = (object)array("card_id" => 1,"cardId" =>1, "heading" => "titre", "key" => "FRA","language_id"=> "FRA");
    $data = ['user' => Auth::user(), 'languages' => Language::getInstances(), 'editable' => True, 'card' => $card];
    return view('card/edit',$data);
});


Route::get('/searchByUser', function () {
    return view('searchByAuthor', array("authors" => User::all()));
})->middleware('auth');
Route::get('api/getAllCardsFromUsers/{id}', 'CardController@getCardsByUser');