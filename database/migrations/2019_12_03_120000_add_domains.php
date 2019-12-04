<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class AddDomains extends Migration {
		/**
		 * Adds an API token for each user, allowing them to make request to the API
		 *
		 * @return void
		 */
		public function up() {
			DB::table('domains')->insert([
				['content' => 'Economic',],
				['content' => 'Legal',],
				['content' => 'Mental Health',],
				['content' => 'Scientific',],
				['content' => 'Somatic Health',],
				['content' => 'Technical',],
				['content' => 'Other',],
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
