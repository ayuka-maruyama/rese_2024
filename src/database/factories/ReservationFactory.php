<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 予約日付を今日から7日前〜今日から20日後のランダムな日付で設定
        $isPastDate = rand(0, 10) === 0;
        $randomDate = $isPastDate ? Carbon::today()->subDays(rand(1, 7)) : Carbon::today()->addDays(rand(1, 20));

        // 時間を11:00〜22:00の間で30分間隔でランダムに設定
        $randomTime = Carbon::createFromFormat('H:i', rand(11, 22) . ':' . (rand(0, 1) * 30 == 0 ? '00' : '30'));

        // ゲスト数を1〜10の間でランダムに設定
        $randomGuests = rand(1, 10);

        return [
            'user_id' => User::where('role', 3)->inRandomOrder()->value('id'),
            'shop_id' => Shop::inRandomOrder()->value('id'),
            'date' => $randomDate->format('Y-m-d'),
            'time' => $randomTime->format('H:i'),
            'number_gest' => $randomGuests,
            'visited' => $isPastDate, // 過去日ならtrue、未来日ならfalse
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
