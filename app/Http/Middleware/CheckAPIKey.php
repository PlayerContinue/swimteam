<?php

namespace App\Http\Middleware;

use Closure;

class CheckAPIKey
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
        //TODO check if key exists in database
        if(!$request->key){
            return false;
        }
        return $next($request);
    }
}
