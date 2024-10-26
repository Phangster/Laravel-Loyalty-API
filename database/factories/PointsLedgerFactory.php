<?php

namespace Database\Factories;

use App\Models\PointsLedger;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PointsLedgerFactory extends Factory
{
    protected $model = PointsLedger::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(), // Generate a UUID for the id
            'user_id' => null,
            'points' => $this->faker->numberBetween(1, 100), // Random points between 1 and 100
            'description' => $this->faker->sentence, // Random description
            'created_at' => now(), // Set created_at
            'updated_at' => now(), // Set updated_at
        ];
    }

    // Allow for specifying a user_id when creating
    public function forUser($userId)
    {
        return $this->state([
            'user_id' => $userId,
        ]);
    }
}
