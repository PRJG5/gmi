<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CardVersion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_card', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            //Foreign key to a card A
            $table->unsignedBigInteger("cardOrigin");
            //Foreign key to a card B
            $table->unsignedBigInteger("cardVersion");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_card');
    }
}
