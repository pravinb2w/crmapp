<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\CompanySubscription;
use App\Models\Customer;
use App\Models\Deal;
use App\Models\DealStage;
use App\Models\LandingPages;
use App\Models\Lead;
use App\Models\Product;
use App\Models\User;
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
        $checkLimitArray = array(
            'users' => 'no_of_employees',
            'dealstages' => 'no_of_deal_stages',
            'customers' => 'no_of_clients',
            'deals' => 'no_of_deals',
            'pages' => 'no_of_pages',
            'products' => 'no_of_products'

        ); 
        if( isset($checkLimitArray[$module]) ) {
            $usedCount = 0;
            $column = $checkLimitArray[$module];
            $info = DB::table('company_subscriptions')
                ->select('subscriptions.*', 'company_subscriptions.startAt', 'company_subscriptions.endAt')
                ->join('subscriptions', function ($join) {
                    $join->on('company_subscriptions.subscription_id', '=', 'subscriptions.id');
                })->where('company_subscriptions.company_id', auth()->user()->company_id)
                ->where('company_subscriptions.status', 1)
                ->where('company_id', auth()->user()->company_id)
                ->first();
            if( isset($info) && !empty($info)) {
                $count = $info->$column ?? 0;
                if( $module == 'dealstages') {
                    $usedCount = DealStage::count();
                } else if( $module == 'users' ) {
                    $usedCount = User::count();
                } else if( $module == 'customers' ) {
                    $usedCount = Customer::count();
                } else if( $module == 'deals' ) {
                    $usedCount = Deal::count();
                } else if( $module == 'pages' ) {
                    $usedCount = LandingPages::count();
                } else if( $module == 'products' ) {
                    $usedCount = Product::count();
                }

                if( $count > $usedCount ) {
                } else {
                    if( isset( $request->id ) && !empty( $request->id ) ) {

                    } else {
                        return abort('403');
                    }
                    
                }
            }
        } else {
            
        }
        return $next($request);
    }
}
