<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\View\View;

class AttendanceSessionCheck
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
        if(session()->has('from_attendance') && session()->has('to_attendance')){
            return $next($request);
        }else{
            return redirect ('/attendance/period/select');
        }
    }
}
