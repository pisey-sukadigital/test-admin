<?php

namespace App\Observers;

use Spatie\Permission\Models\Role;
use App\Models\System\LogActivity;

class RoleObserver
{
    /**
    * Handle the Role "created" event.
    *
    * @param Spatie\Permission\Models $role
    * @return void
    */
    public function creating(Role $role)
    {
        LogActivity::addToLog( 'Role' ,'Created', $role);
    }

    /**
    * Handle the Role "updated" event.
    *
    * @param Spatie\Permission\Models $role
    * @return void
    */
    public function updating(Role $role)
    {
        LogActivity::addToLog( 'Role' ,'Updated', $role);
    }

    /**
    * Handle the Role "deleting" event.
    *
    * @param Spatie\Permission\Models $role
    * @return void
    */
    public function deleting(Role $role)
    {
        LogActivity::addToLog( 'Role' ,'Deleted', $role);
    }
}
