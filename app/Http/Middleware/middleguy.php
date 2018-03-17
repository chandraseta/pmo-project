<?php

namespace app\Http\Middleware;

use Closure;

class middleguy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        echo "role : ".$role;
        return $next($request);
    }
}
