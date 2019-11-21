<?php

use App\Enums\Roles;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('role')->default(Roles::USERS);
        });

        // HARD CODED USERS ADMIN
        DB::table('users')->insert(['name' => 'Administrateur' , 'email' => 'admin@admin.com' , 'password' => Hash::make('administrateur'), 'role' => Roles::ADMIN]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
