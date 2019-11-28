<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpokenLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * fefef
     */
    public function up()
    {
        Schema::create('spoken_languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('languageISO');
            $table->unique(['user_id' , 'languageISO']);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spoken_languages');
    }
}
