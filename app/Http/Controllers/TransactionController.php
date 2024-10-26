<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // List all transactions for a user
    public function index(Request $request)
    {
        $userId = $request->input('user_id');

        // Check if the user_id is provided
        if ($userId) {

            // Fetch transactions for the user
            $transactions = Transaction::where('user_id', $userId)->get();

            // Check if any transactions exist for the user
            if ($transactions->isEmpty()) {
                return response()->json([
                    'message' => 'No transactions found for this user.'
                ], 404); // Return 404 if no transactions found
            }

            // Return transactions if found
            return response()->json($transactions);
        }

        // If user_id is not provided, return an error message
        return response()->json([
            'message' => 'User ID is required.'
        ], 400); // Return 400 if user_id is missing
    }

    // Create a transaction
    public function store(Request $request)
    {
        $uniqueId = (string) Str::uuid();

        $fields = $request->validate([
            'user_id' => 'required|exists:users,id',
            'transaction_amount' => 'required|numeric|min:0',
            'transaction_type' => 'required|in:credit,cash,debit',
            'points_earned' => 'required|integer|min:0',
        ]);

        $fields['id'] = $uniqueId;
        $transaction = Transaction::create($fields);

        return response()->json(['message' => 'Transaction created successfully', 'transaction' => $transaction]);
    }

    // Show a specific transaction
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        return response()->json($transaction);
    }
}
