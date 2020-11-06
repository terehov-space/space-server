<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Role;

class UserObserver
{
    public function created(User $user)
    {
        if (!in_array($user->id, [1, 2, 3, 4])) {
            $defaultRole = Role::find(5);

            $user->roles()->save($defaultRole);
        }
    }
}
