<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TimoKoerber\LaravelJsonSeeder\JsonDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            JsonDatabaseSeeder::class,
            DataSeeder::class
        ]);
    }
}
