<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class RedirectCientIfAuthenticated
{
   
    public function handle(Request $request, Closure $next)
    {
       
        if( session()->has('client') ) {
            return redirect(RouteServiceProvider::CLIENT);
        }

        return $next($request);
    }
}
