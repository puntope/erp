<?php

namespace App\Http\Middleware;

use Closure;

class Authorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        if ((! $request->user()->hasRole($role) && ! $request->user()->isCreator($request->tareas)) || ! $request->user()->active) {
            return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}
