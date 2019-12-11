<?php
namespace App\Http\Controllers;

use App\Card;
use App\Domain;
use App\Language;
use App\Phonetic;
use App\Link;
use App\Note;
use App\Context;
use App\Definition;
use App\Subdomain;
use App\User;
use App\Vote;
use App\Validation;

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
        return view('allCards', [
			'cards' => Card::orderBy('heading', 'ASC')->where('delete','=','0')->get(),
		]);
    }

    /**
     * Returns the view for creating a new card.
     * @return Response the view to create a new card.
     * @author 44422
     */
    public function create()
    {
        return view('card.create', [
            'domains' 	=> Domain::all(),
            'subdomains' => Subdomain::all(),
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
        } else if(isset($request['contextURL']) && strlen($request['contextURL']) > 0){
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
        } else if(isset($request['definitionURL']) && strlen($request['definitionURL']) > 0){
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
    public function show(int $card_id)
    {
        $card = Card::find($card_id);
        return view('card.show', [
            'card'      => $card,
            'owner' 	=> User::find($card->owner_id)
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
                'mail'      => [
					'subject' => trans('cards.mail.remark', ['cardName' => $card->heading]),
					'description' => trans('cards.mail.visit', ['cardLink' => route('cards.show', $card->id)]),
				],
                'card' 		=> $card,
                'domains' 	=> Domain::all(),
                'subdomains' => Subdomain::all(),
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
        if(!isset($card->validation_id)){
            if (Auth::user()->id == $card->owner_id) {
                $card->update($request->all());
                $card->definition->definition_content = $request->definition;
                $card->definition->save();
                $card->note->description = $request->note;
                $card->note->save();
                $card->context->context_to_string = $request->context;
                $card->context->save();
                $card->phonetic->textDescription = $request->phonetic;
                $card->phonetic->save();
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
    }

    /**
     * Removes the specified card from the database.
     * @param Card $card the card to delete.
     * @return Response the view with all the cards.
     * @throws Exception if card to delete cannot be found
     * @author 44422
     */
    public function destroy(int $card_id)
    {
        $card =Card::find($card_id);
        try {
            // SI LA CARTE EST PAS VALIDER ON LA SUPPRIMER PHYSIQUEMENT
            if(!$card->isValided()){
                Link::where('cardA', $card->id)->orWhere('cardB', $card->id)->delete();

                if(Context::find($card->context_id) != null) {
                    Context::find($card->context_id)->delete();
                }
                if(Definition::find($card->definition_id) != null) {
                    Definition::find($card->definition_id)->delete();
                }
                if(Note::find($card->note_id) != null) {
                    Note::find($card->note_id)->delete();
                }
                if(Phonetic::find($card->phonetic_id) != null) {
                    Phonetic::find($card->phonetic_id)->delete();
                }
                // VOTE possède un ondelete cascade sur cardId donc si carte se supprime, vote se supprime !
                $card->delete();
            }else{
                $card->delete = 1;
                $card->save();
            }
        } catch(\Exception $exception) {
            echo $exception;
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
            'card_id'       => '',
            'heading'		=> 'required',
            'headingURL'    => '',
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
            'validation_id' => '',
            'vote_count'    => '',
            'validation_rate'=> 'digits_between:0,100',
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

	public function removeValidation(Request $request){
        $card = Card::where('id',$request->id)->first();
        $card->removeValidation();
        return redirect()->back();
    }


    /**
     * Return all cards from an user
     * @param int userId The user id
     * @return Card[] All cards from an user
     */
    public function getCardsByUser(int $userId) {
        return view('card.index',['cards' => Card::where('owner_id',$userId)->get()]);
    }

    public function linkCard(int $card_id){
        $cardOrigin = Card::find($card_id);
        return view('card.link', [
            'cardOrigin' => $cardOrigin,
            'cardLinked' => $cardOrigin->getCardFilterByLanguage(),
            'userOrigin' => DB::table('users')->where('id', $cardOrigin->owner_id)->first(),
		]);
    }

    public function linkToAnotherCard(Request $request){
        $request->validate([
            'cardOrigin' => 'required',
            'card' => 'required',
        ]);
    $cardA = $request->cardOrigin;
    $cardB = $request->card;
    $l =Link::create(compact('cardA','cardB'));
    return redirect()->back();
    }

   public function showCard($id) {
        $card = Card::find($id);
       return view('card.show', [
           'card' => $card,
            'phonetic'  => $card->phonetic,
            'note'      => $card->note,
            'context'   => $card->context,
            'definition'=> $card->definition,
            'domain' 	=> $card->domain,
            'languages' => Language::all()->where('slug',$card->language_id)->first(),
            'subdomain' => $card->subdomain,
       ]);
   }

   public function linkList(){
     echo "not working yet, todo";
    exit;
    //UTILISER DANS LE FICHIER CARD LA FONCTION getLinkedCard qui retourne les id de toutes les cartes 
    //NE PAS TOUCHER A LA FONCTION SI BESOIN --> 49778
   }
}
