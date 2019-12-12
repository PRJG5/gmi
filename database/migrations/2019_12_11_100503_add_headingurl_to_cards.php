<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeadingurlToCards extends Migration
{
    /**
     * Run the migrations.
     * Add a column 'headingURL' to specify an url to an video if the card have a signed language
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->text('headingURL')->nullable();
            //Should set a trigger to check if 'headingURL' is empty if the language is not signed. But too complex to do it quick
            //Should test if url like
        });
    }

    /**
     * Reverse the migrations.
     * Drop the column 'headingURL
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn('headingURL');
        });
    }
}
