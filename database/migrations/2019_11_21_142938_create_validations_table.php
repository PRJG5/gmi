<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('voteNb')->unsigned()->nullable()->default(null);
            $table->unsignedInteger('userNb')->unsigned()->nullable()->default(null);
            $table->unsignedTinyInteger('validationRate')->unsigned()->nullable()->default(70);
            $table->date('validated_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validations');
    }
}
