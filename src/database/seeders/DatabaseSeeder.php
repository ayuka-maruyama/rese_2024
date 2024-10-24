<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AreaTableSeeder::class,
            GenreTableSeeder::class,
            ShopTableSeeder::class,
            RolesTableSeeder::class,
            StartUserTableSeeder::class,
        ]);
    }
}
