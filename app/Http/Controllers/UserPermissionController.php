<?php

namespace App\Http\Controllers;

use App\Enums\Permissions;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\AdminRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    function updatePermission(User $user, AdminRequest $request)
    {
        $this->validate($request, ['permission.*.*' => 'boolean']);

        $permissions = $request->permission;

        foreach ($permissions as $permissionCategory) {
            foreach ($permissionCategory as $key => $permission) {
                if ($permission)
                    $user->givePermissionTo($key);
                else
                    $user->revokePermissionTo($key);

            }
        }

        return ResponseFormatter::success([],'Permissions updated succesfully');
    }
}
