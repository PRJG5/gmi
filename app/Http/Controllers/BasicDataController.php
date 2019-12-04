<?php

	namespace App\Http\Controllers;

	use App\Domain;
	use App\Language;
	use App\Subdomain;

	/**
	 *
	 */
	class BasicDataController extends Controller {

		public function addSubdomain($name) {
			if(Subdomain::where('content', '=', $name)->count() > 0) {
				return json_encode(['error' => 'Already saved']);
			}
			$subdomain = new Subdomain();
			$subdomain->content = $name;
			$subdomain->save();
			return json_encode(['success' => 'Save']);
		}

		public function addLanguage($name, $iso) {
			if(Language::where('content', '=', $name)->count() > 0) {
				return json_encode(['error' => 'Name already saved']);
			}
			if(Language::where('slug', '=', $iso)->count() > 0) {
				return json_encode(['error' => 'Slug already saved']);
			}
			$language = new Language();
			$language->content = $name;
			$language->slug = $iso;
			$language->save();
			return json_encode(['success' => 'Save']);
		}

		public function addDomain($content) {
			$domain = new Domain();
			$domain->content = $content;
			$domain->save();
		}

	}
