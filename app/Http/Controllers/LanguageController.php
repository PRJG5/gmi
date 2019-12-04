<?php

	namespace App\Http\Controllers;

	use App\Imports\LanguagesImport;
	use App\Language;
	use Illuminate\Http\Request;
	use Illuminate\Validation\ValidationException;
	use Illuminate\View\View;
	use Maatwebsite\Excel\Facades\Excel;

	class LanguageController extends Controller {
		/**
		 * Display a listing of the resource.
		 *
		 * @return View
		 */
		public function index() {

			return view('addBasicData')->with([
				'headers' => [
					'id',
					'content',
					'slug',
				],
				'bodies'  => Language::all(),
			]);
		}

		public function importView() {
			return view('language.import');
		}

		/**
		 * @param Request $request
		 * @throws ValidationException
		 */
		public function import(Request $request) {
			$this->validate($request, [
				'file' => 'required|mimes:xls, xlsx',
			]);
			Excel::import(new LanguagesImport(), $request->file('file'));
		}

	}
