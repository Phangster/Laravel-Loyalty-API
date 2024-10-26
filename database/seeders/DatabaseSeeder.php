<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MembershipTier;
use App\Models\Reward;
use App\Models\Transaction;
use App\Models\PointsLedger;
use App\Models\Redemption;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 4 membership tiers
        $membershipTiers = MembershipTier::factory()->count(4)->create();

        // Create a super admin using the SuperAdminSeeder
        $this->call(SuperAdminSeeder::class);

        // Create 5 users, associating them with a membership tier
        User::factory()
            ->count(5)
            ->create()
            ->each(function ($user) use ($membershipTiers) {
                // Assign a random membership tier to each user
                $user->membership_tier_id = $membershipTiers->random()->id;
                $user->save();

                // Create rewards for each user
                $rewards = Reward::factory()
                    ->count(2) // Adjust the number of rewards per user
                    ->create(['user_id' => $user->id]);

                // Create transactions for each user
                $transactions = Transaction::factory()
                    ->count(3) // Adjust the number of transactions per user
                    ->create(['user_id' => $user->id]);

                // Create points ledger entries for each user
                PointsLedger::factory()
                    ->count(3) // Adjust the number of points ledger entries per user
                    ->create(['user_id' => $user->id]);

                // Create redemptions for each user
                foreach ($rewards as $reward) {
                    Redemption::factory()
                        ->create([
                            'user_id' => $user->id,
                            'reward_id' => $reward->id,
                            'quantity' => rand(1, 5), // Random quantity for redemption
                            'points_spent' => rand(1, $reward->points_required), // Points spent on redemption
                            'redeemed_at' => now(),
                        ]);
                }
            });
    }
}
