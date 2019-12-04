<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class AddLanguages extends Migration {
		/**
		 * Adds an API token for each user, allowing them to make request to the API
		 *
		 * @return void
		 */
		public function up() {
			DB::table('languages')->insert([
				['slug' => 'ALB', 'content' => 'Albanian'],
				['slug' => 'ARA', 'content' => 'Arabic',],
				['slug' => 'ARC', 'content' => 'Aramaic',],
				['slug' => 'BAD', 'content' => 'Banda',],
				['slug' => 'BAM', 'content' => 'Bambara',],
				['slug' => 'BER', 'content' => 'Berber',],
				['slug' => 'BOS', 'content' => 'Bosnian',],
				['slug' => 'BUL', 'content' => 'Bulgarian',],
				['slug' => 'CES', 'content' => 'Czech',],
				['slug' => 'CHE', 'content' => 'Chechen',],
				['slug' => 'CKB', 'content' => 'Central Kurdish',],
				['slug' => 'CNR', 'content' => 'Montenegrin',],
				['slug' => 'DEU', 'content' => 'German',],
				['slug' => 'ENG', 'content' => 'English',],
				['slug' => 'FAS', 'content' => 'Persian',],
				['slug' => 'FRA', 'content' => 'French',],
				['slug' => 'FUL', 'content' => 'Fulah',],
				['slug' => 'GRE', 'content' => 'Greek',],
				['slug' => 'GUJ', 'content' => 'Gujarati',],
				['slug' => 'HBS', 'content' => 'Serbo-Croatian',],
				['slug' => 'HIN', 'content' => 'Hindi',],
				['slug' => 'HRV', 'content' => 'Croatian',],
				['slug' => 'HYE', 'content' => 'Armenian',],
				['slug' => 'ITA', 'content' => 'Italian',],
				['slug' => 'JPN', 'content' => 'Japanese',],
				['slug' => 'KAT', 'content' => 'Georgian',],
				['slug' => 'KAZ', 'content' => 'Kazakh',],
				['slug' => 'KOR', 'content' => 'Korean',],
				['slug' => 'KUR', 'content' => 'Kurdish',], // duplicate with CKB?
				['slug' => 'LIN', 'content' => 'Lingala',],
				['slug' => 'MAN', 'content' => 'Mandingo',],
				['slug' => 'MKD', 'content' => 'Macedonian',],
				['slug' => 'MOL', 'content' => 'Moldavian',], // deprecated
				['slug' => 'NLD', 'content' => 'Dutch',],
				['slug' => 'PAN', 'content' => 'Punjabi',],
				['slug' => 'POL', 'content' => 'Polish',],
				['slug' => 'POR', 'content' => 'Portuguese',],
				['slug' => 'PRS', 'content' => 'Dari',],
				['slug' => 'PUS', 'content' => 'Pashto',],
				['slug' => 'RIF', 'content' => 'Tarifit',],
				['slug' => 'ROM', 'content' => 'Romany',],
				['slug' => 'RON', 'content' => 'Romanian',],
				['slug' => 'RUS', 'content' => 'Russian',],
				['slug' => 'SLK', 'content' => 'Slovak',],
				['slug' => 'SLV', 'content' => 'Slovenian',],
				['slug' => 'SOM', 'content' => 'Somali',],
				['slug' => 'SPA', 'content' => 'Spanish',],
				['slug' => 'SUS', 'content' => 'Susu',],
				['slug' => 'SWA', 'content' => 'Swahili',],
				['slug' => 'TIR', 'content' => 'Tigrinya',],
				['slug' => 'TUK', 'content' => 'Turkmen',],
				['slug' => 'TUR', 'content' => 'Turkish',],
				['slug' => 'UIG', 'content' => 'Uyghur',],
				['slug' => 'UKR', 'content' => 'Ukrainian',],
				['slug' => 'URD', 'content' => 'Urdu',],
				['slug' => 'ZHO', 'content' => 'Chinese',],
				['slug' => 'SFB', 'content' => 'Langue des signes de Belgique Francophone',],
				['slug' => 'VGT', 'content' => 'Vlaamse Gebarentaal',],
				['slug' => 'ILS', 'content' => 'International Sign',],
			]);
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			//
		}
	}
