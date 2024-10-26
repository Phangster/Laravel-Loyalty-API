<?php

namespace Database\Factories;

use App\Models\MembershipTier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MembershipTierFactory extends Factory
{
    protected $model = MembershipTier::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(), // Generate a random name
            'points_required' => $this->faker->numberBetween(10, 1000), // Random points required between 10 and 1000
            'discount_rate' => $this->faker->randomFloat(2, 0, 100), // Random discount rate between 0 and 100 with 2 decimal places
            'created_at' => now(), // Set created_at timestamp
            'updated_at' => now(), // Set updated_at timestamp
        ];
    }
}
