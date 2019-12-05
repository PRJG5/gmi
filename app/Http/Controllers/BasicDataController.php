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
				return response()->json([
					'errors' => [
						'status' => 409,
						'title'  => 'Conflict',
						'detail' => 'A subdomain with this name already exists.',
					],
				], 409);
			}
			$subdomain = new Subdomain();
			$subdomain->content = $name;
			$subdomain->save();
			return response()->json([
				'data' => [
					'status' => 201,
					'title'  => 'Created',
				],
			], 201);
		}

		public function addLanguage($name, $iso) {
			if(Language::where('content', '=', $name)->count() > 0) {
				return response()->json([
					'errors' => [
						'status' => 409,
						'title'  => 'Conflict',
						'detail' => 'A language with this name already exists.',
					],
				], 409);
			}
			if(Language::where('slug', '=', $iso)->count() > 0) {
				return response()->json([
					'errors' => [
						'status' => 409,
						'title'  => 'Conflict',
						'detail' => 'A language with this slug already exists.',
					],
				], 409);
			}
			$language = new Language();
			$language->content = $name;
			$language->slug = $iso;
			$language->save();
			return response()->json([
				'data' => [
					'status' => 201,
					'title'  => 'Created',
				],
			], 201);
		}

		public function addDomain($content) {
			$domain = new Domain();
			$domain->content = $content;
			$domain->save();
		}

	}
