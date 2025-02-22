<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        $isPastDate = rand(0, 10) === 0;
        $randomDate = $isPastDate ? Carbon::today()->subDays(rand(1, 7)) : Carbon::today()->addDays(rand(1, 20));

        $randomTime = Carbon::createFromFormat('H:i', rand(11, 22) . ':' . (rand(0, 1) * 30 == 0 ? '00' : '30'));

        $randomGuests = rand(1, 10);

        return [
            'user_id' => User::where('role', 3)->inRandomOrder()->value('id'),
            'shop_id' => Shop::inRandomOrder()->value('id'),
            'date' => $randomDate->format('Y-m-d'),
            'time' => $randomTime->format('H:i'),
            'number_gest' => $randomGuests,
            'visited' => $isPastDate,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
