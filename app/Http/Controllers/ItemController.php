<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;


class ItemController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::with('user')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|string',
        ]);

        $item = $request->user()->items()->create($fields);
        return ['item' => $item, 'user' => $item->user];
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return ['item' => $item, 'user' => $item->user];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        Gate::authorize('modify', $item);
        $fields = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|string',
        ]);

        $item->update($fields);

        return ['item' => $item, 'user' => $item->user];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        Gate::authorize('modify', $item);
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}
