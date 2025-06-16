<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSuperAdmin
{
    
    public function handle($request, Closure $next)
    {
        // Una, iche-check kung naka-login ba ang user at kung ang role niya ay 'superadmin'
        if (!Auth::check() || Auth::user()->role !== 'superadmin') {
            // Kung hindi siya superadmin or hindi naka-login, ibabalik siya sa dashboard
            // at magpapakita ng 'Unauthorized' na error message
            return redirect('/dashboard')->with('error', 'Unauthorized.');
        }

        // Kung pasado ang user (naka-login at superadmin), tuloy ang request
        return $next($request);
    }
}
