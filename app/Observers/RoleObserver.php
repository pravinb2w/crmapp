<?php

namespace App\Observers;

use App\Models\Role;

class RoleObserver
{
    public function creating(Role $role)
    {
        $role->company_id = auth()->user()->company_id ?? null;
    }
}
