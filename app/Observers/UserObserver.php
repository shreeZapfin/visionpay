<?php

namespace App\Observers;

use App\Models\User;
use App\Services\CheckRegistrationService;

class UserObserver
{

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User $user
     * @return void
     */
    public function updated(User $user)
    {
        if ($user->is_registration_completed)
            return;

        if ((new CheckRegistrationService($user))->checkIfUserRegistrationComplete()) {
            $user->is_registration_completed = true;
            $user->save();
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
