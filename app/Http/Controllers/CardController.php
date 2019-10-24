<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

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
        return view('card.create', ['languages' => $this->getFakeLanguages()]);
    }

    /**
     * Stores a newly created card in the database.
     * @param  Request  $request the incoming request.
     * @return Request the view with the newly created card.
     * @author 44422
     */
    public function store(Request $request)
    {
        $card = Card::create($this->validateData($request));
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
        return view('card.show', ['card' => $card, 'languages' => $this->getFakeLanguages()]);
    }

    /**
     * Displays the form for editing the specified card.
     * @param  Card $card the card to edit
     * @return Response the view for the card to edit.
     * @author 44422
     */
    public function edit(Card $card)
    {
        return view('card.edit', ['card' => $card, 'languages' => $this->getFakeLanguages()]);
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
        $card->update($this->validateData($request));
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
    private function validateData(Request $request)
    {
        return $request->validate([
            'heading'       => 'required',
            // phonetic.
            // domain.
            // sub-domain.
            // definition.
            // context.
            // note.
            'language_id'   => 'required',
        ]);
    }

    /**
     * This function fakes the languages available.
     * This is only temporary and will be replaced by the real languages from the database.
     * // TODO
     * @return object an array of languages.
     * @author 44422
     */
    private function getFakeLanguages()
    {
        return json_decode('[
            {"language_id":1,"language_name":"Français"},
            {"language_id":2,"language_name":"Anglais"},
            {"language_id":3,"language_name":"Néerlandais"},
            {"language_id":3,"language_name":"Allemand"}
            ]', false);
    }
}
