<?php

namespace App\Policies;

use App\Models\UserBank;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserBankPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
//        if ($user->is_admin)
            return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\UserBank $user_bank
     * @return mixed
     */
    public function view(User $user, UserBank $user_bank)
    {
        if ($user->id == $user_bank->user_id)
            return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
            return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\UserBank $admin_bank_detail
     * @return mixed
     */
    public function update(User $user, UserBank $user_bank)
    {
        if ($user->id == $user_bank->user_id)
            return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\UserBank $user_bank
     * @return mixed
     */
    public function delete(User $user, UserBank $user_bank)
    {
        return false;

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\UserBank $user_bank
     * @return mixed
     */
    public function restore(User $user, UserBank $user_bank)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\UserBank $user_bank
     * @return mixed
     */
    public function forceDelete(User $user, UserBank $user_bank)
    {
        //
    }
}
