<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMediaAttribut extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phonetics', function (Blueprint $table) {
            $table->text('image')->nullable();
            $table->text('url')->nullable();
            $table->text('son')->nullable();
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->text('image')->nullable();
            $table->text('url')->nullable();
            $table->text('son')->nullable();
        });

        Schema::table('contexts', function (Blueprint $table) {
            $table->text('image')->nullable();
            $table->text('url')->nullable();
            $table->text('son')->nullable();
        });
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
