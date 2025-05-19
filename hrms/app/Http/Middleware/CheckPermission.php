<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission)
    {
        if (!Auth::check()) {
            Log::error('Unauthenticated user attempted to access route with permission: ' . $permission);
            abort(403, 'Unauthorized: Please log in.');
        }

        if (!Auth::user()->hasPermission($permission)) {
            Log::warning('User ID: ' . Auth::id() . ' denied access for permission: ' . $permission);
            abort(403, 'Unauthorized: You do not have permission to perform this action.');
        }

        return $next($request);
    }
}