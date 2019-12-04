<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class AddApiTokenUser extends Migration {
		/**
		 * Adds an API token for each user, allowing them to make request to the API
		 *
		 * @return void
		 */
		public function up() {
			Schema::table('users',
				function(Blueprint $table) {
					$table->string('api_token')->unique()->nullable()->default(NULL);
				});
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
