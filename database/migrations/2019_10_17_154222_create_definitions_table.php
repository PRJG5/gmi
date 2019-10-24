<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('definition')) {
            Schema::create('definitions', function (Blueprint $table) {
                $table->bigIncrements('definition_id');
                $table->string('definition_content');
                $table->integer('card');
                $table->foreign('card') //name of class "fiche"  --- HERE : Card
                    ->references('card_id')
                    ->on('cards')
                    ->onDelete('cascade');
            });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('definitions');
    }
}
