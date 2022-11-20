<?php

namespace App\Observers;

use App\Models\Activity;

class ActivityObserver
{
    public function creating(Activity $activity)
    {
        $activity->company_id = auth()->user()->company_id ?? 1;
    }
}
