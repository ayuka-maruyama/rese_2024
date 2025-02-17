<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 3)->pluck('id')->toArray();
        $shops = Shop::pluck('id')->toArray();
        $combinations = [];

        while (count($combinations) < 40) {
            $user_id = $users[array_rand($users)];
            $shop_id = $shops[array_rand($shops)];

            // すでに同じ組み合わせが存在する場合はスキップ
            if (isset($combinations["$user_id-$shop_id"])) {
                continue;
            }

            $combinations["$user_id-$shop_id"] = true;

            // Factoryで他のカラムを補完
            Evaluation::factory()->create([
                'user_id' => $user_id,
                'shop_id' => $shop_id,
            ]);
        }
    }
}
