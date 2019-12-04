<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class AddConstraintLinksTableUniqueCardaCardb extends Migration {
		/**
		 * Run the migrations.
		 * @return void
		 * @author 49102 43121
		 */
		public function up() {
			Schema::table('links',
				function(Blueprint $table) {
					$table->unique([
						'card_a',
						'card_b',
					])->change();

					DB::statement('ALTER TABLE links ADD CONSTRAINT chk_card_different CHECK (card_a <> card_b);');
				});
		}
	}
