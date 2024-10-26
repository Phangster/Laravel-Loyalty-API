<?php

namespace Database\Factories;

use App\Models\Reward;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RewardFactory extends Factory
{
    protected $model = Reward::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(), // Generate a UUID for the id
            'name' => $this->faker->word(), // Random reward name
            'points_required' => $this->faker->numberBetween(1, 100), // Random points required
            'description' => $this->faker->sentence(), // Random description
            'stock_quantity' => $this->faker->numberBetween(1, 100), // Random stock quantity
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
