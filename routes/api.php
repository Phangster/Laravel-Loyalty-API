<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\PointsLedgerController;
use App\Http\Controllers\RedemptionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MembershipTierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('items', ItemController::class);

Route::apiResource('rewards', RewardController::class);
Route::apiResource('points-ledger', PointsLedgerController::class);
Route::apiResource('redemptions', RedemptionController::class)->except(['store']);
Route::post('redemptions/redeem', [RedemptionController::class, 'redeem']);
Route::apiResource('transactions', TransactionController::class);
Route::apiResource('membership-tiers', MembershipTierController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/update_profile/{id}', [AuthController::class, 'update']);
});
