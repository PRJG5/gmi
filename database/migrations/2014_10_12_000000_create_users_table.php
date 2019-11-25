<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations..
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->rememberToken();
			$table->timestamps();
		});

		DB::table('users')->insert(['name' => 'med' , 'email' => 'meihdi1997@gmail.com' , 'password' => Hash::make('med')]);
		DB::table('users')->insert(['name' => 'test' , 'email' => 'test@test.com' , 'password' =>  Hash::make('test') ]);
		DB::table('users')->insert(['name' => 'root' , 'email' => 'root@test.com' , 'password' =>  Hash::make('rootroot') ]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}
