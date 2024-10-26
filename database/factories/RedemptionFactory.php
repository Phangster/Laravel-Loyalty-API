<?php

namespace Database\Factories;

use App\Models\Redemption;
use App\Models\User;
use App\Models\Reward;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RedemptionFactory extends Factory
{
    protected $model = Redemption::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(),
            'user_id' => null,
            'reward_id' => null,
            'quantity' => $this->faker->numberBetween(1, 5), // Random quantity
            'points_spent' => $this->faker->numberBetween(1, 100), // Random points spent
            'redeemed_at' => now(), // Set to current time; adjust as necessary for testing
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
