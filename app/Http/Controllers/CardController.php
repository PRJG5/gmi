<?php

	namespace App\Http\Controllers;

	use App\Card;
	use App\Context;
	use App\Definition;
	use App\Domain;
	use App\Language;
	use App\Link;
	use App\Note;
	use App\Phonetic;
	use App\Subdomain;
	use App\User;
	use App\Vote;
	use Exception;
	use Illuminate\Contracts\View\View as View;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\DB;
	use Symfony\Component\HttpFoundation\Response;

	/**
	 * Handles the different CRUD actions about the cards.
	 * @author 44422
	 */
	class CardController extends Controller {

		/**
		 * Returns an HTML view with all the cards in the database.
		 * The view extends the app layout, which means it will contain all the user interface.
		 * To only get the "raw" contents of all cards, use the getRaw method
		 * @return View the HTML view with all existing cards.
		 * @author 44422
		 */
		public function index() {
			return view('card.index', [
				'cards' => Card::all(),
			]);
		}

		/**
		 * Returns the view for creating a new card.
		 * @return View the HTML view to create a new card.
		 * @author 44422
		 */
		public function create() {
			return view('card.create', [
				'domain'    => Domain::all(),
				'subdomain' => Subdomain::all(),
				'languages' => User::find(Auth::id())->getLanguages(),
			]);
		}

		/**
		 * @param Request $request
		 * @return Card the card linked
		 * @author 49762 49262
		 */
		private function createCardLinkedObjects(Request $request) {
			if(isset($request['phonetic']) && strlen($request['phonetic']) > 0) {
				$phonetic = new Phonetic([
					'text_description' => $request['phonetic'],
				]);
				$phonetic->save();
				$request->merge([
					'phonetic_id' => $phonetic->id,
				]);
			}

			if(isset($request['note']) && strlen($request['note']) > 0) {
				$note = new Note([
					'description' => $request['note'],
				]);
				$note->save();
				$request->merge([
					'note_id' => $note->id,
				]);
			}

			if(isset($request['context']) && strlen($request['context']) > 0) {
				$context = new Context([
					'context_to_string' => $request['context'],
				]);
				$context->save();
				$request->merge([
					'context_id' => $context->id,
				]);
			}

			if(isset($request['definition']) && strlen($request['definition']) > 0) {
				$note = new Definition([
					'definition_content' => $request['definition'],
				]);
				$note->save();
				$request->merge([
					'definition_id' => $note->id,
				]);
			}
			$card = new Card($this->validateData($request));
			$card->save();
			return $card;
		}

		/**
		 * Stores a newly created card in the database.
		 * @param Request $request the incoming request.
		 * @return mixed the view with the newly created card.
		 * @author 44422
		 */
		public function store(Request $request) {
			if(!Auth::user()) { // TODO replace with authorize method
				return response()->json([
					'errors' => [
						'status' => 401,
						'title'  => 'Unauthorized',
						'detail' => 'You must be logged on to do that.',
					],
				], 401);
			}
			$request->merge([
				'owner_id' => Auth::user()->id,
			]);

			$card = $this->createCardLinkedObjects($request);

			return redirect()->action('CardController@show',
				[$card]);
		}

		/**
		 * Displays the specified card.
		 * @param Card $card the card to show.
		 * @return View the view of the card.
		 * @author 44422
		 */
		public function show(Card $card) {
			return view('card.show', [
				'card'       => $card,
				'context'    => Context::find($card->context_id),
				'definition' => Definition::find($card->definition_id),
				'domain'     => Domain::find($card->domain_id),
				'language'   => Language::where('slug',
					$card->language_id)->first(),
				'mail'       => [
					'subject' => trans('card.mailSubject', [
						'cardHeading' => $card->heading,
					]),
					'body' => trans('card.mailBody', [
						'cardLink' => route('cards.show', $card->id),
					]),
				],
				'note'       => Note::find($card->note_id),
				'owner'      => User::find($card->owner_id),
				'phonetic'   => Phonetic::find($card->phonetic_id),
				'subdomain'  => Subdomain::find($card->subdomain_id),
				'user'       => Auth::user(),
			]);
		}

		/**
		 * Displays the form for editing the specified card.
		 * @param Card $card the card to edit
		 * @return View the view for the card to edit.
		 * @author 44422
		 */
		public function edit(Card $card) {
			return view('card.edit',
				[
					'card'       => $card,
					'context'    => Context::find($card->context_id),
					'definition' => Definition::find($card->definition_id),
					'domains'    => Domain::all(),
					'languages'  => Language::all(),
					'note'       => Note::find($card->note_id),
					'owner'      => User::find($card->owner_id),
					'phonetic'   => Phonetic::find($card->phonetic_id),
					'subdomains' => Subdomain::all(),
				]);
		}

		/**
		 * Updates the specified resource in database.
		 * @param Request $request the incoming request with the new data.
		 * @param Card $card the existing card to edit.
		 * @return Response the view with the edit card.
		 * @author 44422
		 */
		public function update(Request $request, Card $card) {
			$request->merge([
				'heading'     => $card->heading,
				'language_id' => $card->language_id,
				'owner_id'    => $card->owner_id,
			]);

			if(Auth::user()->id == $card->owner_id) {
				if(isset($request['phonetic']) && strlen($request['phonetic']) > 0) {
					if($card->phonetic_id) {
						$phonetic = Phonetic::find($card->phonetic_id);
					} else {
						$phonetic = new Phonetic();
						$card->phonetic_id = $phonetic->id;
					}
					$phonetic->text_description = $request->phonetic;
					$phonetic->save();
				}
				if(isset($request['definition']) && strlen($request['definition']) > 0) {
					if($card->definition_id) {
						$definition = Definition::find($card->definition_id);
					} else {
						$definition = new Definition();
						$card->definition_id = $definition->id;
					}
					$definition->definition_content = $request->definition;
					$definition->save();
				}
				if(isset($request['note']) && strlen($request['note']) > 0) {
					if($card->note_id) {
						$note = Note::find($card->note_id);
					} else {
						$note = new Note();
						$card->note_id = $note->id;
					}
					$note->description = $request->note;
					$note->save();
				}
				if(isset($request['context']) && strlen($request['context']) > 0) {
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

				$card->update($this->validateData($request));

				return redirect()->action('CardController@show',
					[$card]);
			} else {
				$request->merge([
					'owner_id' => Auth::user()->id,
				]);

				$cardVersion = $this->createCardLinkedObjects($request);
				$card->versions()->save($cardVersion);
				return redirect()->action('CardController@show',
					[$cardVersion]);
			}
		}

		/**
		 * Removes the specified card from the database.
		 * @param Card $card the card to delete.
		 * @return Response the view with all the cards.
		 * @throws Exception if card to delete cannot be found
		 * @author 44422
		 */
		public function destroy(Card $card) {
			Link::where('card_a',
				$card->id)->orWhere('card_b',
				$card->id)->delete();
			Context::find($card->context_id)->delete();
			Definition::find($card->definition_id)->delete();
			Note::find($card->note_id)->delete();
			Phonetic::find($card->phonetic_id)->delete();
			Vote::where('card_id',
				$card->id)->delete();
			$card->delete();
			return redirect()->action('CardController@index');
		}

		public function getRawCards(Array $cards) {
			return join('<br>',
				array_map(function($card) {
					return $this->getRawCard((object) $card);
				}, $cards),
			);
		}

		public function getRawCard($card) {
			return view('card.raw',
				[
					'card'       => $card,
					'context'    => Context::find($card->context_id),
					'definition' => Definition::find($card->definition_id),
					'domain'     => Domain::find($card->domain_id),
					'language'   => Language::where('slug',
						$card->language_id)->first(),
					'note'       => Note::find($card->note_id),
					'owner'      => User::find($card->owner_id),
					'phonetic'   => Phonetic::find($card->phonetic_id),
					'subdomain'  => Subdomain::find($card->subdomain_id),
					'user'       => Auth::user(),
				])->render();
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
				'context_id'    => '',
				'context'       => '',
				'definition_id' => '',
				'definition'    => '',
				'domain_id'     => '',
				'heading'       => 'required',
				'language_id'   => 'required',
				'note_id'       => '',
				'note'          => '',
				'owner_id'      => 'required',
				'owner'         => '',
				'phonetic_id'   => '',
				'phonetic'      => '',
				'subdomain_id'  => '',
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
		 * Returns the view with all the cards of the logged in user
		 * @return mixed All cards from an user
		 */
		public function myCards() {
			return view('myCards',
				[
					'cards' => Card::where('owner_id',
						Auth::id())->get(),
				]);
		}

		/**
		 * Return all cards from an user
		 * @param int userId The user id
		 * @return mixed All cards from an user
		 */
		public function getAllCardsFromUser(int $userId) {
			$rawCards = $this->getRawCards(Card::where('owner_id', $userId)->get()->toArray());
			return empty($rawCards) ? '<div class="alert alert-warning" role="alert">' . trans('card.noCards') . '</div>' : $rawCards;
		}

		public function linkCard(Card $cardOrigin, Card $cardLinked) {
			return view('card.link', [
				'cardOrigin' => $cardOrigin,
				'cardLinked' => $cardLinked,
				'languages'  => Language::all(),
				'userOrigin' => DB::table('users')->where('id',
					$cardOrigin->owner_id)->first(),
				'userLinked' => DB::table('users')->where('id',
					$cardLinked->owner_id)->first(),
			]);
		}

		public function showCard($id) {
			return view('card',
				[
					'card' => Card::find($id),
				]);
		}

	}
