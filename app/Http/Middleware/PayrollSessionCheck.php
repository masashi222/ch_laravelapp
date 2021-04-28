<?php

namespace App\Http\Middleware;

use Closure;

class PayrollSessionCheck
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
        if(session()->has('from_payroll') && session()->has('to_payroll')){
            return $next($request);
        }else{
            return redirect ('/payroll/period/select');
        }
    }
}
