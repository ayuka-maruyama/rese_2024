<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationsTableSeeder extends Seeder
{
    public function run(): void
    {
        Reservation::factory()->count(20)->create();
    }
}
