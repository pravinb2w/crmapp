<?php

namespace App\Observers;

use App\Models\Audit;

class AuditObserver
{
    /**
     * Handle the Audit "created" event.
     *
     * @param  \App\Models\Audit  $audit
     * @return void
     */
    public function creating(Audit $audit)
    {
        $audit->company_id = auth()->user()->company_id ?? null;
    }

    /**
     * Handle the Audit "updated" event.
     *
     * @param  \App\Models\Audit  $audit
     * @return void
     */
    public function updated(Audit $audit)
    {
        //
    }

    /**
     * Handle the Audit "deleted" event.
     *
     * @param  \App\Models\Audit  $audit
     * @return void
     */
    public function deleted(Audit $audit)
    {
        //
    }

    /**
     * Handle the Audit "restored" event.
     *
     * @param  \App\Models\Audit  $audit
     * @return void
     */
    public function restored(Audit $audit)
    {
        //
    }

    /**
     * Handle the Audit "force deleted" event.
     *
     * @param  \App\Models\Audit  $audit
     * @return void
     */
    public function forceDeleted(Audit $audit)
    {
        //
    }
}
