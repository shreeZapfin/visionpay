<?php

namespace App\Policies;

use App\Models\TransferLimitScheme;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransferLimitSchemePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
      if($user->is_admin)
          return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TransferLimitScheme  $transferLimitScheme
     * @return mixed
     */
    public function view(User $user, TransferLimitScheme $transferLimitScheme)
    {
        if($user->is_admin)
            return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->is_admin)
            return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TransferLimitScheme  $transferLimitScheme
     * @return mixed
     */
    public function update(User $user, TransferLimitScheme $transferLimitScheme)
    {
        if($user->is_admin)
            return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TransferLimitScheme  $transferLimitScheme
     * @return mixed
     */
    public function delete(User $user, TransferLimitScheme $transferLimitScheme)
    {
        if($user->is_admin)
            return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TransferLimitScheme  $transferLimitScheme
     * @return mixed
     */
    public function restore(User $user, TransferLimitScheme $transferLimitScheme)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TransferLimitScheme  $transferLimitScheme
     * @return mixed
     */
    public function forceDelete(User $user, TransferLimitScheme $transferLimitScheme)
    {
        if($user->is_admin)
            return true;
    }
}
