<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(),
            'user_id' => User::factory(), // Associate with a User
            'transaction_amount' => $this->faker->randomFloat(2, 10, 1000), // Random amount between 10 and 1000
            'transaction_type' => $this->faker->randomElement(['credit', 'debit', 'cash']), // Random transaction type
            'points_earned' => $this->faker->numberBetween(1, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
