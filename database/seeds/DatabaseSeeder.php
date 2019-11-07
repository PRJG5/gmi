<?php

use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ContextSeeder::class);
        $this->call(CardTableSeeder::class);
        $this->call(PhoneticTableSeeder::class);
    }
}
