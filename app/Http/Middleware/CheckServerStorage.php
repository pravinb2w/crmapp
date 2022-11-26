<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckServerStorage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $serverStorage = planSettings('server_space');//in gb
        $usedStorage = checkServerSpace() / 1024;
        if( $serverStorage < $usedStorage ) {
            abort(403);
        } else {
            return $next($request);

        }
    }
}
