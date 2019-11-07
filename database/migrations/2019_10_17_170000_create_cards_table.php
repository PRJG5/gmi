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
            $table->text('definition')->charset('utf8');
            // sub-domain.
            // context.
            // note.
            $table->text('language_id')->charset('utf8');
            $table->unsignedBigInteger('owner_id');

            /**
             * LIST OF ALTER TABLE
             */
            ///$table->foreign('owner_id')->references('id')->on('users');
        });
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
