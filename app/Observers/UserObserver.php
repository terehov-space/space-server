<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Role;

class UserObserver
{
    public function created(User $user)
    {
        if ($user->id !== 1) {
            $defaultRole = Role::find(5);

            $user->roles()->save($defaultRole);
        }
    }
}
