<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CompanySubscription;
use DB;

class EnsureHasAddLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $module)
    {
        $info = DB::table('company_subscriptions')
                ->join('subscriptions', function ($join) {
                    $join->on('company_subscriptions.subscription_id', '=', 'subscriptions.id');
                })->where('company_subscriptions.status', 1)->first();

        if( isset($info) && !empty($info)) {
            
            if( $module == 'template' ) {
                $access_limit = $info->no_of_email_templates ?? 0;
                //get count of all email templates
                $template_count = DB::table('email_templates')->count();
                if( $template_count < $access_limit ) {

                } else {
                    return abort('403');
                }
            }
            
        }
        return $next($request);
    }
}
