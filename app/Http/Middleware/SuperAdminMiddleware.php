<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Redirect to login if the user is not authenticated
            return redirect()->route('login');
        }

        $user = Auth::user();
        // Check if the user's role is super admin (role = 1)
        if ($user->role != 1) {
            // Return a 403 Unauthorized response if the user is not a super admin
            abort(403, 'Unauthorized');
        }

        // Allow the request to continue if the user is a super admin
        return $next($request);
    }
}
