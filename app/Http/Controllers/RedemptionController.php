<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reward;
use App\Models\Redemption;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RedemptionController extends Controller
{
    // Redeem a reward for a user
    public function redeem(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'reward_id' => 'required|exists:rewards,id',
            'quantity' => 'required|integer|min:1', // Ensure quantity is at least 1
        ]);

        $userId = $request->input('user_id');
        $rewardId = $request->input('reward_id');

        $user = User::findOrFail($userId);
        $reward = Reward::findOrFail($rewardId);

        if ($user->totalPoints() < $reward->points_required) {
            return response()->json(['message' => 'Not enough points to redeem this reward'], 400);
        }

        // Deduct points
        $user->pointsLedger()->create([
            'id' => Str::uuid(),
            'points' => -$reward->points_required,
            'description' => 'Redemption of reward: ' . $reward->name,
        ]);

        // Record redemption
        $redemption = Redemption::create([
            'id' => Str::uuid(),
            'user_id' => $userId,
            'quantity' => $request->input('quantity'),
            'reward_id' => $rewardId,
            'points_spent' => $reward->points_required,
            'redeemed_at' => now(),
        ]);

        return response()->json(['message' => 'Reward redeemed successfully', 'redemption' => $redemption]);
    }

    // Show redemptions for a user
    public function index(Request $request)
    {
        $userId = $request->input('user_id');

        // Check if the user_id is provided
        if ($userId) {
            // Fetch redemptions for the user
            $redemptions = Redemption::where('user_id', $userId)->get();

            // Check if any redemptions exist for the user
            if ($redemptions->isEmpty()) {
                return response()->json([
                    'message' => 'No redemptions found for this user.'
                ], 404); // Return 404 if no redemptions found
            }

            // Return redemptions if found
            return response()->json($redemptions);
        }

        // If user_id is not provided, return an error message
        return response()->json([
            'message' => 'User ID is required.'
        ], 400); // Return 400 if user_id is missing
    }
}
