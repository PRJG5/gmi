<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            //Foreign key to a card A
            $table->unsignedBigInteger("cardA");
            //Foreign key to a card B
            $table->unsignedBigInteger("cardB");
            
            ##Their references
            $table->foreign('cardA')->references('id')->on('cards');
            $table->foreign('cardB')->references('id')->on('cards');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
