<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TimoKoerber\LaravelJsonSeeder\JsonDatabaseSeeder as Seed;

class DatabaseSeeder extends Seeder
{
    /**
     * runs seed found in database/json
     * tests with single instance of each model found in database/json/tests
     */
    public function run()
    {
        $this->call(Seed::class);
    }
}
