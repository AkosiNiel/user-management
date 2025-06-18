<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSuperAdmin
{
    public function handle($request, Closure $next)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must be logged in.');
        }

        $user = Auth::user();

        // Check if user has 'superadmin' role
        if ($user->role !== 'superadmin') {
            // Optionally, log or show what role was found (for debugging)
            return abort(403, 'Access denied. Your role: ' . ($user->role ?? 'none'));
        }

        // Proceed if superadmin
        return $next($request);
    }
}
