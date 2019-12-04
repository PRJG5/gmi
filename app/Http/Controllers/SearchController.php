<?php

	namespace App\Http\Controllers;

	use App\Card;
	use App\Enums\Language;
	use App\User;
	use Illuminate\Http\Request;

	/**
	 *
	 */
	class SearchController extends Controller {

		/**
		 * Show the search cards view
		 */
		public function searchCardView() {
			return view('searchCard', [
				'languages' => Language::getInstances(),
			]);
		}

		public function searchCard(Request $request) {
			$search = $request->get('search');
			$language = $request->get('languages');
			$cards = NULL;

			if($search == '' && ($language == 'All' || $language == '')) {
				$cards = Card::all();
			} else {
				if($language == 'All') {

					$cards = Card::where('heading', 'like', $search . '%')->get();

				} else {
					if($search == '') {
						$cards = Card::where('language_id', '=', $language)->get();
					} else {
						$cards = Card::where('heading', 'like', $search . '%')->where('language_id', $language)->get();
					}
				}
			}

			return view('allCards', [
				'cards'     => $cards,
				'languages' => Language::getKeys(),
			]);
		}

		public function searchCardByAuthorView() {
			return view('searchCardByAuthor', [
				'authors' => User::all(),
			]);
		}
	}
