<?php

use Illuminate\Database\Seeder;

use App\Card;

/**
 * Seeder file for the Card table.
 * @author 44422
 */
class CardTableSeeder extends Seeder {

    /**
     * Creates 50 fake cards into the database.
     * @author 44422
     */
    public function run() {
        factory(Card::class, 50)->create();
    }
}
