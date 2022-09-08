<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        
    }

    public function boot(Request $request)
    {
        Paginator::defaultView('vendor.pagination.bootstrap-4');
 
        Paginator::defaultSimpleView('vendor.pagination.bootstrap-4');
    }
}
