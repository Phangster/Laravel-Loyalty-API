<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PointsLedger;
use App\Services\MembershipTierService;
use Illuminate\Http\Request;

class PointsLedgerController extends Controller
{
    protected $membershipTierService;

    public function __construct(MembershipTierService $membershipTierService)
    {
        $this->membershipTierService = $membershipTierService;
    }

    // Add points to user ledger
    public function addPoints(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $points = $request->input('points');
        $ledger = PointsLedger::create([
            'user_id' => $userId,
            'points' => $points,
            'description' => $request->input('description')
        ]);

        // Update membership tier after points are added
        $this->membershipTierService->assignTier($user);

        return response()->json(['message' => 'Points added successfully', 'ledger' => $ledger]);
    }

    // Remove points from user ledger
    public function removePoints(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        $points = $request->input('points');
        $ledger = PointsLedger::create([
            'user_id' => $userId,
            'points' => -$points,
            'description' => $request->input('description')
        ]);

        // Update membership tier after points are removed
        $this->membershipTierService->assignTier($user);

        return response()->json(['message' => 'Points removed successfully', 'ledger' => $ledger]);
    }

    // Show points ledger for a user
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $ledger = $user->pointsLedger;

        return response()->json($ledger);
    }
}
