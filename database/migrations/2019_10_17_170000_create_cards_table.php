<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates or migrates the "Cards" table,
 * containing the cards and their informations.
 * @see https://laravel.com/docs/6.x/migrations
 * @author 44422
 */
class CreateCardsTable extends Migration
{
    /**
     * Creates the "Cards" table and the necessary columns.
     * @return void
     * @author 44422
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('card_id');

            /*
            Also know as "vedette" of the card.
            The heading must support utf8 (or utf16, but probably not supported by all databases) chars,
            since non-latin languages may be used.
            */
            $table->text('heading')->charset('utf8');
            // phonetic.
            // domain.
            $table->text('definition')->charset('utf8')->nullable();
            $table->text('context')->charset('utf8');

            // sub-domain.
            // context.
            $table->text('note')->charset('utf8');
            $table->text('language_id')->charset('utf8');
            $table->unsignedBigInteger('owner_id');

            /**
             * LIST OF ALTER TABLE
             */
            ///$table->foreign('owner_id')->references('id')->on('users');
        });

        DB::table('cards')->insert(['heading' => 'Acathésie' , 'definition' =>'Incapacité de rester assis.' ,'language_id' =>'1' , 'owner_id' =>'1'] );
        DB::table('cards')->insert(['heading' => 'mal di testa' , 'definition' =>'Douleur de l’extrémité céphalique, qui peut constituer à elle seule la maladie, comme dans la migraine, ou représenter un symptôme d’une affection telle qu’une tumeur cérébrale ou une affection méningée.' ,'language_id' =>'7' , 'owner_id' =>'3'] );
        DB::table('cards')->insert(['heading' => 'Algostase' , 'definition' =>'Verminderen en soms zelfs volledig afschaffen van het gevoel van pijn.' ,'language_id' =>'2' , 'owner_id' =>'2'] );
    }

    /**
     * Deletes the "Cards" table and all its entries.
     * @return void
     * @author 44422
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
