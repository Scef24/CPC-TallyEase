<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string[] ...$roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if ($user) {
            Log::info('RoleMiddleware: User role', ['role' => $user->role]);

            if (!in_array($user->role, $roles)) {
                Log::warning('RoleMiddleware: Forbidden access', ['user' => $user]);
                return response()->json(['message' => 'Forbidden: You do not have the required role'], 403);
            }
        } else {
            Log::warning('RoleMiddleware: No authenticated user');
            return response()->json(['message' => 'Forbidden: No authenticated user'], 403);
        }

        return $next($request);
    }
}
