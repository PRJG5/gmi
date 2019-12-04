<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class AddSubdomains extends Migration {
		/**
		 * Adds an API token for each user, allowing them to make request to the API
		 *
		 * @return void
		 */
		public function up() {
			DB::table('subdomains')->insert([
				['content' => 'Anesthesia',],
				['content' => 'Asylum',],
				['content' => 'Cardiology',],
				['content' => 'Dentistry',],
				['content' => 'Dermatology',],
				['content' => 'Diabetology',],
				['content' => 'Endocrinology',],
				['content' => 'Gastroenterology',],
				['content' => 'Geriatric',],
				['content' => 'Gynecology',],
				['content' => 'Justice',],
				['content' => 'Nephrology',],
				['content' => 'Neurology',],
				['content' => 'Oncology',],
				['content' => 'Otorhinolaryngology',],
				['content' => 'Orthopedic Traumatology',],
				['content' => 'Pediatric',],
				['content' => 'Physiotherapy',],
				['content' => 'Pneumonology',],
				['content' => 'Police',],
				['content' => 'Radiology',],
				['content' => 'Surgery',],
				['content' => 'Urology',],
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
