<?php

namespace App\Policies;

use App\Enums\Permissions;
use App\Helpers\UserType;
use App\Models\FundRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FundRequestPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\FundRequest $fundRequest
     * @return mixed
     */
    public function view(User $user, FundRequest $fundRequest)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\FundRequest $fundRequest
     * @return mixed
     */
    public function update(User $user, FundRequest $fundrequest)
    {
        if ($fundrequest->sender_user_id == $user->id || $fundrequest->requester_user_id == $user->id) #Accepting or rejecting should be done who sends the funds only or who has requested
            return true;
        if ($fundrequest->is_wallet_refill)  #Request for deposit from admin
            if ($user->user_type_id == UserType::Staff)
                if ($user->hasPermissionTo(Permissions::MANAGE_USER_WALLET))
                    return true;

        return false;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\FundRequest $fundRequest
     * @return mixed
     */
    public function delete(User $user, FundRequest $fundRequest)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\FundRequest $fundRequest
     * @return mixed
     */
    public function restore(User $user, FundRequest $fundRequest)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\FundRequest $fundRequest
     * @return mixed
     */
    public function forceDelete(User $user, FundRequest $fundRequest)
    {
        //
    }
}
