<?php

namespace App\Http\Middleware;

use Closure;

class VerifyResidentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        // WE need  an authenticated user
        if (! $user) {
            return response(['unauthorised'], 401);
        }

        // The user must be an admin or a logged in resident
        if ($user->role != 1) {
            return response(['Forbidden', 'Not allowed to access this route!'], 403);
        }

        return $next($request);
    }
}
