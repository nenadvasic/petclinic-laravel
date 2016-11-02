<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure                  $next
     * @param  string                   $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if ( ! $request->user()->roleIn($roles)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }

}
