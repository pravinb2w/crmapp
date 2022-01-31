<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CompanySettings;

class SetViewVariable
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
        
        $user = User::find(Auth::id());
        View::share('cm_favicon', $user->company->site_favicon);
        View::share('cm_logo', $user->company->site_logo);
        View::share('cm_profile_image', $user->image);
        View::share('cm_role', $user->role->role ?? 'SuperAdmin');

        return $next($request);
    }
}
