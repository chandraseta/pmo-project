<?php

namespace app\Http\Middleware;

use Closure;

class terminateMid
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
        echo "Executing termination";
        return $next($request);
    }
    
    public function terminate($request, $response){
        echo "<br>Execting termination";
    }
}
