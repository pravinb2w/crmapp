<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

class CompanyScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        
        if( isset( auth()->user()->company_id ) ) {
            $company_id = auth()->user()->company_id;
        } else {
            $company = DB::table('company_settings')->where('site_code', request()->segment(1))->first();
            $company_id = $company->id;
        }
        $builder->where('company_id', $company_id);
    }
}