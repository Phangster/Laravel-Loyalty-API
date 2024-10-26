<?php

namespace App\Services;

use App\Models\User;
use App\Models\MembershipTier;

class MembershipTierService
{
    /**
     * Assign a membership tier to the user based on their points.
     *
     * @param User $user
     * @return MembershipTier|null
     */
    public function assignTier(User $user): ?MembershipTier
    {
        // Get the total points collected by the user
        $totalPoints = $user->pointsLedger()->sum('points');

        // Find the membership tier that corresponds to the total points
        $tier = MembershipTier::where('min_points', '<=', $totalPoints)
            ->where('max_points', '>=', $totalPoints)
            ->first();

        if ($tier) {
            // Update the user's membership tier if necessary
            $user->membership_tier_id = $tier->id;
            $user->save();
        }

        return $tier;
    }
}
