<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddSignedLanguageToLanguage extends Migration
{
    /**
     * Run the migrations. Add a column isSigned to the table 'languages'. 
     * The column is boolean, to true if the language is signed, false otherwise.
     * The migration update any column with a slug equals to 'SSI', 'LSBF' or 'LSBN' to true 
     *
     * @return void
     */
    public function up()
    {
        // Add the column
        Schema::table('languages', function (Blueprint $table) {
            $table->boolean("isSigned")->default(false);
        });
        
        //Update the rows
        DB::table('languages')
            ->where('slug', 'SSI')
            ->orWhere('slug', 'LSBF')
            ->orWhere('slug', 'VGT')
            ->update(['isSigned' => true]);

    }

    /**
     * Reverse the migrations. Nothing to do
     *
     * @return void
     */
    public function down()
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->dropColumn('isSigned');
        });
    }
}
