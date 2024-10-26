<?php

namespace App\Http\Controllers;

use App\Models\MembershipTier;
use Illuminate\Http\Request;

class MembershipTierController extends Controller
{
    // List all membership tiers
    public function index()
    {
        $tiers = MembershipTier::all();
        return response()->json($tiers);
    }

    // Add a new membership tier
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'points_required' => 'required|integer',
            'discount_rate' => 'required|numeric',
        ]);

        $membershipTier = MembershipTier::create($fields);

        return response()->json(['message' => 'Membership tier created successfully', 'tier' => $membershipTier]);
    }

    // Show a specific membership tier
    public function show($id)
    {
        $tier = MembershipTier::findOrFail($id);
        return response()->json($tier);
    }

    // Update a membership tier
    public function update(Request $request, $id)
    {
        $tier = MembershipTier::findOrFail($id);
        $tier->update($request->all());
        return response()->json(['message' => 'Membership tier updated successfully']);
    }

    // Delete a membership tier
    public function destroy($id)
    {
        $tier = MembershipTier::findOrFail($id);
        $tier->delete();
        return response()->json(['message' => 'Membership tier deleted successfully']);
    }
}
