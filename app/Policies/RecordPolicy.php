<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RecordPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Record $record): bool
    {
        if ($user->isUser() or $user->isAdministrator()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Record $record): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Record $record): bool
    {
        if ($user->isAdministrator() or ($user->id == $record->user_id and $user->isUser())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Record $record): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Record $record): bool
    {
        //
    }
}
