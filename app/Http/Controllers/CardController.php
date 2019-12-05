<?php
namespace App\Http\Controllers;

//TODO: pour ceux qui devront traduire, Remplacer le contenu de ces constantes
define("FORMAT_SUBJECT", "Remarque concernant votre carte %s");
define("FORMAT_DESCRIPTION", "Pour consulter votre carte, veuillez suivre ce lien: %s/cards/%s");


use App\Card;
use App\Enums\Domain;
use App\Phonetic;
use App\Link;
use App\Note;
use App\Context;
use App\Definition;
use App\User;
use App\vote;
use App\Enums\Language;
use App\Enums\Subdomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


/**
 * Handles the different CRUD action about the cards.
 * @author 44422
 */
class CardController extends Controller
{

    /**
     * Displays a list of all the cards.
     * @return a list with all the cards in the database.
     * @author 44422
     */
    public function index()
    {
        return view('allCards',['cards' => Card::all()]);
    }

    /**
     * Returns the view for creating a new card.
     * @return Response the view to create a new card.
     * @author 44422
     */
    public function create()
    {
        return view('card.create', [
            'domain' 	=> Domain::getInstances(),
            'subdomain' => Subdomain::getInstances(),
			'languages' => Auth::user()->getLanguages()
        ]);
    }

     /**
     * @author 49762 49262
     * 
     */
    private function create_card(Request $request){
        if(isset($request['phonetic']) && strlen($request['phonetic']) > 0){
            $phonetic = Phonetic::create([
                'textDescription' => $request['phonetic'],
            ]);
            $phonetic->save();
            $request->merge([
                'phonetic_id'=> $phonetic->id,
            ]);
        }

        if(isset($request['note']) && strlen($request['note']) > 0){
            $note = Note::create([
                'description' => $request['note'],
            ]);
            $note->save();
            $request->merge([
                'note_id'=> $note->id,
            ]);
        }

        if(isset($request['context']) && strlen($request['context']) > 0){
            $context = Context::create([
                'context_to_string' => $request['context'],
            ]);
            $context->save();
            $request->merge([
                'context_id'=> $context->id,
            ]);
        }

        if(isset($request['definition']) && strlen($request['definition']) > 0){
            $note = Definition::create([
                'definition_content' => $request['definition'],
            ]);
            $note->save();
            $request->merge([
                'definition_id'=> $note->id,
            ]);
        }
        $card = Card::create($this->validateData($request, true));
		$card->save();
        return $card;
    }

    /**
     * Stores a newly created card in the database.
     * @param  Request  $request the incoming request.
     * @return Request the view with the newly created card.
     * @author 44422
     */
    public function store(Request $request)
    {
		if(!Auth::user()) { // TODO replace with authorize method
			abort(403, 'Unauthorized action. You must be logged in to create a card.');
        }
		$request->merge([
            'owner_id' => Auth::user()->id,
        ]);

        $card = $this->create_card($request);

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
			'card' 		=> $card,
			'domain' 	=> Domain::getInstances(),
			'languages' => DB::table("cards")->where('language_id',$card->language_id),
			'subdomain' => Subdomain::getInstances(),
            'owner' 	=> User::find($card->owner_id),
            'phonetic'  => DB::table('phonetics')->where('id', $card->phonetic_id)->first(),
            'note'      => DB::table('notes')->where('id', $card->note_id)->first(),
            'context'   => DB::table('contexts')->where('id',$card->context_id)->first(),
            'definition'=> DB::table('definitions')->where('id',$card->definition_id)->first()
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
        $subject = sprintf(FORMAT_SUBJECT, $card->heading);
        $description = sprintf(FORMAT_DESCRIPTION, $_SERVER['HTTP_HOST'], $card->card_id);
        return view('card.edit', [
            'mail'      => ["subject" => urlencode($subject),'description' => urlencode($description)],
            'card' 		=> $card,
			'domain' 	=> Domain::getInstances(),
			'languages' => DB::table("cards")->where('id',$card->language_id),
			'subdomain' => Subdomain::getInstances(),
            'owner' 	=> User::find($card->owner_id),
            'phonetic'  => DB::table('phonetics')->where('id', $card->phonetic_id)->first(),
            'note'      => DB::table('notes')->where('id', $card->note_id)->first(),
            'context'   => DB::table('contexts')->where('id',$card->context_id)->first(),
            'definition'=> DB::table('definitions')->where('id',$card->definition_id)->first()
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
        if(Auth::user()->id == $card->owner_id) {
            $card->update($request->all());
            return redirect()->action('CardController@show', [$card]);
        } else {
            $request->merge([
                'owner_id' => Auth::user()->id,
            ]);

            $cardVersion = $this->create_card($request);
            $card->versions()->save($cardVersion);
            return redirect()->action('CardController@show', [$cardVersion]);
        }
    }

    /**
     * Removes the specified card from the database.
     * @param Card $card the card to delete.
     * @return Response the view with all the cards.
     * @throws Exception if card to delete cannot be found
     * @author 44422
     */
    public function destroy(Card $card)
    {
        try { 
            Link::where('cardA',
                $card->id)->orWhere('cardB',
                $card->id)->delete();
            Context::find($card->context_id)->delete();
            Definition::find($card->definition_id)->delete();
            Note::find($card->note_id)->delete();
            Phonetic::find($card->phonetic_id)->delete();
            Vote::where('card_id',
                $card->id)->delete();
            $card->delete();
        } catch(\Exception $exception) {

        }
        return redirect()->action('CardController@index');
    }

    /**
     * Validates the data received.
     * @param Request $request the request
     * @param bool $creating if the card is being created or not
     * @return array the validated data in a Card object.
     * @author 44422
     * @see https://laravel.com/docs/6.x/validation
     */
    private function validateData(Request $request, bool $creating) {
		$tab = [
            'heading'		=> 'required',
            'language_id'	=> 'required',
            'phonetic'		=> '',
            'phonetic_id'   => '',
            'domain_id'		=> '',
            'subdomain_id'	=> '',
            'definition'	=> '',
            'definition_id' => '',
            'context'		=> '',
            'context_id'    => '',
            'note_id'		=> '',
            'note'          => '',
            'owner_id'	    => 'required',
		];
		if(!$creating) {
			array_merge($tab, [
				'card_id'	=> 'required',
			]);
		}
        return $request->validate($tab);
	}

    /**
     * Determines if the user is authorized to make this request.
     * @param $ability
     * @param $arguments
     * @return bool
     * @author 44422
     * @see https://laravel.com/docs/6.x/validation
     */
	public function authorize($ability, $arguments) {
		return true; // TODO
	}

    /**
     * Return all cards from an user
     * @param int userId The user id
     * @return Card[] All cards from an user
     */
    public function getCardsByUser(int $userId) {
        return view('card.index',['cards' => Card::where('owner_id',$userId)->get()]);
    }

    public function linkCard(Card $cardOrigin, Card $cardLinked){
        return view('card.link', [
            'cardOrigin' => $cardOrigin,
            'cardLinked' => $cardLinked,
			'languages' => Language::getInstances(),
            'userOrigin' => DB::table('users')->where('id', $cardOrigin->owner_id)->first(),
			'userLinked' => DB::table('users')->where('id', $cardLinked->owner_id)->first(),

		]);
    }

   public function showCard($id) {
       return view('card', ['card' => Card::find($id)]);
   }

}
