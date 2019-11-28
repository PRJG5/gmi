<?php
namespace App\Http\Controllers;

use App\Card;
use App\Context;
use App\Definition;
use App\Enums\Domain;
use App\Enums\Language;
use App\Enums\Subdomain;
use App\Note;
use App\Phonetic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

/**
 * Handles the different CRUD action about the cards.
 * @author 44422
 */
class CardController extends Controller
{

	/**
	 * Displays a list of all the cards.
	 * @return Card[] a list with all the cards in the database.
	 * @author 44422
	 */
	public function index() {
		return view('card.index', [
			'cards' => Card::all(),
		]);
	}

	/**
	 * Returns the view for creating a new card.
	 * @return Response the view to create a new card.
	 * @author 44422
	 */
	public function create() {
		return view('card.create', [
			'domain'	=> Domain::getInstances(),
			'subdomain' => Subdomain::getInstances(),
			'languages' => Language::getInstances(),
		]);
	}

	/**
	 * Stores a newly created card in the database.
	 * @param Request $request the incoming request.
	 * @return Request the view with the newly created card.
	 * @author 44422
	 */
	public function store(Request $request) {
		$request->merge([
			'owner_id' => Auth::user()->id,
		]);
		if(isset($request['phonetic']) && strlen($request['phonetic']) > 0) {
			$phonetic = Phonetic::create([
				'textDescription' => $request['phonetic'],
			]);
			$phonetic->save();
			$request->merge([
				'phonetic_id'=> $phonetic->id,
			]);
		}
		if(isset($request['definition']) && strlen($request['definition']) > 0) {
			$definition = Definition::create([
				'definition_content' => $request['definition'],
			]);
			$definition->save();
			$request->merge([
				'definition_id'=> $definition->id,
			]);
		}
		if(isset($request['note']) && strlen($request['note']) > 0) {
			$note = Note::create([
				'description' => $request['note'],
			]);
			$note->save();
			$request->merge([
				'note_id'=> $note->id,
			]);
		}
		if(isset($request['context']) && strlen($request['context']) > 0) {
			$context = Context::create([
				'context_to_string' => $request['context'],
			]);
			$context->save();
			$request->merge([
				'context_id'=> $context->id,
			]);
		}
		$card = Card::create($this->validateData($request));
		$card->save();
		return redirect()->action('CardController@show', [$card]);
	}

	/**
	 * Displays the specified card.
	 * @param Card $card the card to show.
	 * @return Response the view of the card.
	 * @author 44422
	 */
	public function show(Card $card) {
		return view('card.show', [
			'card'			=> $card,
			'context'		=> Context::find($card->context_id),
			'definition'	=> Definition::find($card->definition_id),
			'domain'		=> Domain::getInstances(),
			'languages'		=> Language::getInstances(),
			'note'			=> Note::find($card->note_id),
			'owner'			=> User::find($card->owner_id),
			'phonetic'		=> Phonetic::find($card->phonetic_id),
			'subdomain'		=> Subdomain::getInstances(),
		]);
	}

	/**
	 * Displays the form for editing the specified card.
	 * @param Card $card the card to edit
	 * @return Response the view for the card to edit.
	 * @author 44422
	 */
	public function edit(Card $card) {
		return view('card.edit', [
			'card'			=> $card,
			'context'		=> Context::find($card->context_id),
			'definition'	=> Definition::find($card->definition_id),
			'domain'		=> Domain::getInstances(),
			'languages'		=> Language::getInstances(),
			'mail'	 => [
				'subject'	=> trans('card.mailSubject', ['cardHeading' => $card->heading]),
				'body'		=> trans('card.mailBody', ['cardLink' => route('cards.show', $card->id)]),
			],
			'note'			=> Note::find($card->note_id),
			'owner'			=> User::find($card->owner_id),
			'phonetic'		=> Phonetic::find($card->phonetic_id),
			'subdomain'		=> Subdomain::getInstances(),
		]);
	}

	/**
	 * Updates the specified resource in database.
	 * @param Request $request the incoming request with the new datas.
	 * @param Card $card the existing card to edit.
	 * @return Response the view with the edit card.
	 * @author 44422
	 */
	public function update(Request $request, Card $card) {
		$request->merge([
			'heading'	=>  $card->heading,
			'language_id'	=>  $card->language_id,
			'owner_id' 		=> $card->owner_id,
		]);

		$card->update($this->validateData($request));

		if(isset($request['phonetic']) &&
			strlen($request['phonetic']) > 0) {
			$phonetic;
			if($card->phonetic_id) {
				$phonetic = Phonetic::find($card->phonetic_id);
			} else {
				$phonetic = new Phonetic();
				$card->phonetic_id = $phonetic->id;
			}
			$phonetic->textDescription = $request->phonetic;
			$phonetic->save();
		}
		if(isset($request['definition']) &&
			strlen($request['definition']) > 0) {
			$definition;
			if($card->definition_id) {
				$definition = Definition::find($card->definition_id);
			} else {
				$definition = new Definition();
				$card->definition_id = $definition->id;
			}
			$definition->definition_content = $request->definition;
			$definition->save();
		}
		if(isset($request['note']) &&
			strlen($request['note']) > 0) {
			$note;
			if($card->note_id) {
				$note = Note::find($card->note_id);
			} else {
				$note = new Note();
				$card->note_id = $note->id;
			}
			$note->description = $request->note;
			$note->save();
		}
		if(isset($request['context']) &&
			strlen($request['context']) > 0) {
			$context;
			if($card->context_id) {
				$context = Context::find($card->context_id);
			} else {
				$context = new Context();
				$card->context_id = $context->id;
			}
			$context->context_to_string = $request->context;
			$context->save();
		}
		$card->save();
		return redirect()->action('CardController@show', [$card]);
	}

	/**
	 * Removes the specified card from the database.
	 * @param Card $card the card to delete.
	 * @return Response the view with all the cards.
	 * @throws Exception if card to delete cannot be found
	 * @author 44422
	 */
	public function destroy(Card $card) {
		$this->authorize();
		try {
			$card->delete();
		} catch(\Exception $exception) {

		}
		return redirect()->action('CardController@index');
	}

	/**
	 * Validates the data received.
	 * @param Request $request the request
	 * @return array the validated data in a Card object.
	 * @author 44422
	 * @see https://laravel.com/docs/6.x/validation
	 */
	private function validateData(Request $request) {
		return $request->validate([
			'context_id'	=> '',
			'context'		=> '',
			'definition_id'	=> '',
			'definition'	=> '',
			'domain_id'		=> '',
			'heading'		=> 'required',
			'language_id'	=> 'required',
			'note_id'		=> '',
			'note'			=> '',
			'owner_id'		=> 'required',
			'owner'			=> '',
			'phonetic_id'	=> '',
			'phonetic'		=> '',
			'subdomain_id'	=> '',
		]);
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
		return Card::where('owner_id', $userId)->get();
	}

	/**
	 * Create a link between two cards
	 * @param Card $cardOrigin the origin card
	 * @param Card $cardLinked the card to origin card is linked to
	 */
	public function linkCard(Card $cardOrigin, Card $cardLinked) {
		return view('card.link', [
			'cardOrigin'	=> $cardOrigin,
			'cardLinked'	=> $cardLinked,
			'languages'		=> Language::getInstances(),
			'userOrigin'	=> Users::find($cardOrigin->owner_id),
			'userLinked'	=> Users::find($cardLinked->owner_id),
		]);
	}
}
