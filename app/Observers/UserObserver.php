<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->company_id = auth()->user()->company_id ?? null;
    }
}
