<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Permission;
use DB;
use Illuminate\Support\Facades\Route;

class EnsureHasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $access )
    {
        $role_id = auth()->user()->role_id;
        $route_name = Route::currentRouteName();
        $currentRoutes = explode(".", $route_name);
        $route_name = current( $currentRoutes );
        $path_name = str_replace("/","",$request->route()->getAction()['prefix'] );
        if( $role_id ) {
            $info = DB::table('role_permissions')
                    ->join('role_permission_menu', function ($join) use ($route_name) {
                        $join->on('role_permissions.id', '=', 'role_permission_menu.permission_id')
                            ->where('role_permission_menu.menu', '=', $route_name);
                    })->where('role_permissions.role_id', $role_id)->first();
            if( isset($info) && !empty($info)) {
                if( isset( $info->$access ) && $info->$access == 'on') {

                } else {
                    return abort('403');
                }
            } else {
                return abort('403');
            }
        }
        
        return $next($request);
    }
}
