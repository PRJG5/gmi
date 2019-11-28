<?php

use Illuminate\Database\Seeder;

use App\Phonetic;

/**
 * Seeder file for the Phonetic table.
 * @author 44424
 */
class PhoneticTableSeeder extends Seeder {

    /**
     * Creates 50 fake phonetic into the database.
     * @author 44424
     */
    public function run() {
        factory(Phonetic::class, 50)->create();
    }
}
