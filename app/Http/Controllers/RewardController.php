<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RewardController extends Controller
{
    // List all rewards
    public function index()
    {
        $rewards = Reward::all();
        return response()->json($rewards);
    }

    // Add a new reward
    public function store(Request $request)
    {
        $uniqueId = (string) Str::uuid();

        $fields = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'points_required' => 'required|integer',
            'stock_quantity' => 'required|integer',
        ]);

        $fields['id'] = $uniqueId;

        $reward = Reward::create($fields);
        return response()->json(['message' => 'Reward created successfully', 'reward' => $reward]);
    }

    // Show a specific reward
    public function show($id)
    {
        $reward = Reward::findOrFail($id);
        return response()->json($reward);
    }

    // Update a reward
    public function update(Request $request, $id)
    {
        $reward = Reward::findOrFail($id);
        $reward->update($request->all());
        return response()->json(['message' => 'Reward updated successfully']);
    }

    // Delete a reward
    public function destroy($id)
    {
        $reward = Reward::findOrFail($id);
        $reward->delete();
        return response()->json(['message' => 'Reward deleted successfully']);
    }
}
