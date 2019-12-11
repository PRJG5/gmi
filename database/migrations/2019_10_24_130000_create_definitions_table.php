<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates or migrates the "Definitions" table,
 * containing the definitions and the related card
 * @see https://laravel.com/docs/6.x/migrations
 * @author 49102
 */
class CreateDefinitionsTable extends Migration
{
    /**
     * Creates the "Definitions" table and the necessary columns.
     * 
     * @return void
     * @author 49102
     */
    public function up()
    {
        
            Schema::create('definitions', function (Blueprint $table) {
                $table->bigIncrements('id');

                /*
                The content of the definition
                */
                $table->longtext('definition_content');

            });
        
        
    }

    /**
     * Deletes the "Definitions" table and all the entries.
     *
     * @return void
     * @author 49102
     */
    public function down()
    {
        Schema::dropIfExists('definitions');
    }
}
