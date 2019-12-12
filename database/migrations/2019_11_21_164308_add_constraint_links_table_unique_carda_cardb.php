<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddConstraintLinksTableUniqueCardaCardb extends Migration
{
    /**
     * Run the migrations.
     * @author 49102 43121
     * @return void
     */
    public function up()
    {
        Schema::table('links', function (Blueprint $table) {
            $table->unique(['cardA' , 'cardB'])->change();
            DB::statement('ALTER TABLE links ADD CONSTRAINT chk_card_different CHECK (cardA <> cardB);');
        });
    } 
}
