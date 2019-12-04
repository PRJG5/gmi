<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Facades\Schema;

	class CreateUsersTable extends Migration {
		/**
		 * Run the migrations..
		 *
		 * @return void
		 */
		public function up() {
			Schema::create('users',
				function(Blueprint $table) {
					$table->bigIncrements('id');
					$table->string('name');
					$table->string('email')->unique();
					$table->timestamp('email_verified_at')->nullable();
					$table->string('password');
					$table->rememberToken();
					$table->timestamps();
				});

			DB::table('users')->insert([
				[
					'name'     => 'med',
					'email'    => 'meihdi1997@gmail.com',
					'password' => Hash::make('med'),
				],
				[
					'name'     => 'test',
					'email'    => 'test@test.com',
					'password' => Hash::make('test'),
				],
				[
					'name'     => 'root',
					'email'    => 'root@test.com',
					'password' => Hash::make('rootroot'),
				],
			]);
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			Schema::dropIfExists('users');
		}
	}
