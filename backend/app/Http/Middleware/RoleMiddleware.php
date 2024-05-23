<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        Log::info('RoleMiddleware: User role', ['role' => $user ? $user->role : 'None']);

        if (!$user || !in_array($user->role, $roles)) {
            Log::warning('RoleMiddleware: Forbidden access', ['user' => $user]);
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
