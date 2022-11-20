<?php

namespace App\Http\Middleware;

use App\Models\CompanySettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class CompanyExist
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
        $companyCode = $request->segment(1);
       
        //check companycode exist in database
        $companyInfo = CompanySettings::where(['site_code' => $companyCode, 'status' => 1])->first();
        
        if( isset( $companyInfo ) && !empty( $companyInfo ) ) {
            if( $companyInfo->is_owner == 1 || ( isset($companyInfo->subscription) && !empty( $companyInfo->subscription ) )) {
                return $next($request);
            } else {
                return redirect()->route('subscription-not-found');
            }
        }
        return redirect()->route('company-not-found');
        
    }
}
