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
        $this->call(setting_seeder::class);
        $this->call(user_sedeer::class);
        // $this->call(account_seeder::class);
    }
}
