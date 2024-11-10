<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evaluation>
 */
class EvaluationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $evaluations = rand(1, 5);

        return [
            'user_id' => User::where('role', 3)->inRandomOrder()->value('id'),
            'shop_id' => Shop::inRandomOrder()->value('id'),
            'evaluation' => $evaluations,
            'comment' => $this->faker->text(25),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}