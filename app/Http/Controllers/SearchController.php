<?php

	namespace App\Http\Controllers;

	use App\Card;
	use App\Language;
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
				'languages' => Language::all(),
			]);
		}

		public function searchCard(Request $request) {
			$search = trim($request->heading);
			$language = $request->lang;

			if($language == '*' || $language == '') {
				if(empty($search)) {
					$cards = Card::all();
				} else {
					$cards = Card::where('heading', 'like', '%' . $search . '%')->get();
				}
			} else {
				if(empty($search)) {
					$cards = Card::where('language_id', $language)->get();
				} else {
					$cards = Card::where('heading', 'like', $search . '%')->where('language_id', $language)->get();
					$cards2 = Card::where('heading', 'like', '%' . $search . '%')->where('language_id', $language)->get();
					
					$cards->concat($cards2);
				}
			}

			return view('card.list', [
				'cards' => $cards,
			]);
		}

		public function searchCardByAuthorView() {
			return view('searchCardByAuthor', [
				'authors' => User::all(),
			]);
		}
	}
