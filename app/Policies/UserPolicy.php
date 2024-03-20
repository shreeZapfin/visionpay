<?php

namespace App\Policies;

use App\Enums\Permissions;
use App\Enums\UserType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\User $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
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
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\User $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
//        return ($user->id === $model->id || #Authorized user can edit himselfs permission
//            in_array($user->user_type_id ,[UserType::Admin,UserType::Agent,UserType::Staff])); #Admin/Agent or Staff can update a user

        if ($user->id === $model->id)
            return true;

        if ($user->is_admin)
            return true;


        $hasPermission = false;


        if(request()->route()->uri == 'api/user/{user}/edit')
            if ($user->hasPermissionTo(Permissions::VIEW_USER))
                $hasPermission = true;



        if (request()->route()->uri == 'api/user/{user}') {
            if (request()->has('is_kyc_verified'))  //verification field update permission
                if ($user->hasPermissionTo(Permissions::MANAGE_USER_VERIFICATION))
                    $hasPermission = true;


            //basic details update permission
            if (
                request()->has('first_name') ||
                request()->has('last_name') ||
                request()->has('address') ||
                request()->has('date_of_birth') ||
                request()->has('gender') ||
                request()->has('business_name')
            )
                if ($user->hasPermissionTo(Permissions::EDIT_USER_BASIC_DETAILS))
                    $hasPermission = true;

        }

        //Document upload permission
        if (
            request()->route()->uri == 'api/user/kyc-document/{user}' ||
            request()->route()->uri == 'api/user/selfie-image/{user}' ||
            request()->route()->uri == 'api/user/profile-pic/{user}' ||
            request()->route()->uri == 'api/user/business/company-tin-image/{user}' ||
            request()->route()->uri == 'api/user/business/company-reg-image/{user}'
        ) {
            if ($user->hasPermissionTo(Permissions::UPLOAD_USER_DOCUMENT))
                $hasPermission = true;
        }

        return $hasPermission;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\User $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\User $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\User $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
