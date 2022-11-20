<?php

namespace App\Observers;

use Illuminate\Support\Facades\DB;

class ModelObserver
{
    public function creating($model)
    {
        if( request()->segment(1) != 'register') {
            if( isset( auth()->user()->company_id ) ) {
                $company_id = auth()->user()->company_id;
            } else {
                $company = DB::table('company_settings')->where('site_code', request()->segment(1))->first();
                $company_id = $company->id;
            }
            $model->company_id = $company_id;
        }
        
    }
}
