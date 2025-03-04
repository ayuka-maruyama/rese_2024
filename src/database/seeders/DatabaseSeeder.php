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
            RolesTableSeeder::class,
            StartUserTableSeeder::class,
            AreaTableSeeder::class,
            GenreTableSeeder::class,
            ShopTableSeeder::class,
            ReservationsTableSeeder::class,
            FavoriteSeeder::class,
            EvaluationSeeder::class,
        ]);
    }
}
