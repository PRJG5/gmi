<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	/**
	 * New implementation of Language with a model
	 */
	class CreateLanguagesTable extends Migration {
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up() {
			Schema::create('languages',
				function(Blueprint $table) {
					$table->bigIncrements('id');
					$table->string('content')->unique();
					$table->string('slug')->unique();
				});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			Schema::dropIfExists('languages');
		}
	}
