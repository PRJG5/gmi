<?php

namespace App\Http\Controllers;

use App\Card;
use App\User;
use App\Enums\Language;
use App\Phonetic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/**
 * Handles the different CRUD action about the cards.
 * @author 44422
 */
class CardController extends Controller
{

    /**
     * Displays a list of all the cards.
     * @return Response a list with all the cards in the database.
     * @author 44422
     */
    public function index()
    {
        return Card::all();
    }

    /**
     * Returns the view for creating a new card.
     * @return Response the view to create a new card.
     * @author 44422
     */
    public function create()
    {
        return view('card.create', [
			'languages' => Language::getInstances(),
		]);
    }

    /**
     * Stores a newly created card in the database.
     * @param  Request  $request the incoming request.
     * @return Request the view with the newly created card.
     * @author 44422
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->merge(['owner_id' => $user->id]);
        if(isset($request['phonetic'])){
            $phonetic = Phonetic::create(['textDescription' => $request['phonetic']]);
            $phonetic->save();
            $request->merge(['phonetic_id'=> $phonetic->id]);
        }
        $card = Card::create($this->validateData($request, true));
		$card->save();
        return redirect()->action('CardController@show', [$card]);
    }

    /**
     * Displays the specified card.
     * @param  Card $card the card to show.
     * @return Response the view of the card.
     * @author 44422
     */
    public function show(Card $card)
    {
        return view('card.show', [
			'card' => $card,
            'phonetic' => DB::table('phonetics')->where('id', $card->phonetic_id)->first(),
			'user' => User::find($card->owner_id),
			'languages' => Language::getInstances()
		]);
    }

    /**
     * Displays the form for editing the specified card.
     * @param  Card $card the card to edit
     * @return Response the view for the card to edit.
     * @author 44422
     */
    public function edit(Card $card)
    {
        return view('card.edit', [
			'card' => $card,
			'languages' => Language::getInstances(),
			'user' => DB::table('users')->where('id', $card->owner_id)->first(),
		]);
    }

    /**
     * Updates the specified resource in database.
     * @param  Request  $request the incoming request with the new datas.
     * @param  Card  $card the existing card to edit.
     * @return Response the view with the edit card.
     * @author 44422
     */
    public function update(Request $request, Card $card)
    {
        $card->update($this->validateData($request, false));
        return redirect()->action('CardController@show', [$card]);
    }

    /**
     * Removes the specified card from the database.
     * @param  Card  $card the card to delete.
     * @return Response the view with all the cards.
     * @author 44422
     */
    public function destroy(Card $card)
    {
        $card->delete();
        return redirect()->action('CardController@index');
    }

    /**
     * Validates the data recieved.
     * @param Request the request to validate
     * @return array the validated data in a Card object.
     * @author 44422
     */
    private function validateData(Request $request, bool $creating)
    {
        $tab = [
            'heading' => 'required',
            // 'phonetic',
            // domain.
            // sub-domain.
            // definition.
            // context.
            // note.
            'language_id' => 'required',
            'owner_id' => 'required',
        ];
        if(!$creating){
            array_merge($tab, ['card_id' => 'required']);
        }
        return $request->validate($tab);
    }
    
    /**
     * Return all cards from an user
     * @param userId The user id
     * @return All cards from an user
     */
    public function getCardsByUser($userId) {
        return Card::where('owner_id', $userId)->get();
    }
}
