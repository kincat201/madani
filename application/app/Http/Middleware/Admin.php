<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Util\Constant;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        if(!in_array(Auth::user()->role,$roles)){
            return redirect()->back();
        }
        return $next($request);
    }
}
