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

use App\Enums\Language;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/card/create', function () {
    // Use Auth::user() and not facory
    $user = factory('App\User')->make();
    $data = ['user' => $user, 'languages' => Language::getInstances(), 'editable' => True, 'card' => factory('App\Card')->make()];
    return view('card/create',$data);
});

Route::post('/card/create/submit', 'CardController@store')->name('createCard');

Route::get('/card/{id}/edit', function ($id) {
    //  Use Card::find($id) and not factory when we have finish all test 
    $data = ['user' => Auth::user(), 'languages' => Language::getInstances(), 'editable' => True, 'card' => factory('App\Card')->make()];
    return view('card/edit',$data);
});
