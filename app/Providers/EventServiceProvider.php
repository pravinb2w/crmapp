<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Audit;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use App\Observers\ActivityObserver;
use App\Observers\AuditObserver;
use App\Observers\RoleObserver;
use App\Observers\StatusObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
 
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

  
    public function boot()
    {
        
    }
}
