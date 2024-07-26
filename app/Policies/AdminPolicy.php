<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, User $current) {
        if ($user->isAdministrator() and !$current->isAdministrator()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
