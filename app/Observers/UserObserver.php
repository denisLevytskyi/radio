<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Freq;
use App\Models\Record;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $keys1 = Freq::where('user_id', '=', $user->id)->get()->pluck('id');
        Freq::destroy($keys1);
        $keys2 = Record::where('user_id', '=', $user->id)->get()->pluck('id');
        Record::destroy($keys2);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
