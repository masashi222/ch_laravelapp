<?php

namespace App\Http\Middleware;

use Closure;

class ShiftSessionCheck
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
        if(session()->has('from_shift') && session()->has('to_shift')){
            return $next($request);
        }else{
            return redirect ('/shift/period/select');
        }
    }
}
