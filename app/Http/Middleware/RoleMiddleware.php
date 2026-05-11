<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        // Flatten roles array in case they come as comma-separated string
        $allowedRoles = [];
        foreach ($roles as $role) {
            // Split by comma if needed
            $allowedRoles = array_merge($allowedRoles, array_map('trim', explode(',', $role)));
        }

        if (!in_array(Auth::user()->role, $allowedRoles)) {
            abort(403, 'Unauthorized - Role: ' . Auth::user()->role . ' not in [' . implode(', ', $allowedRoles) . ']');
        }

        return $next($request);
    }
}
