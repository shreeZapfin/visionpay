<?php

namespace App\Http\Controllers;

use App\Events\UserEventCreated;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\UserEventUpdateRequest;
use App\Models\User;
use App\Services\UserEventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEventController extends Controller
{
    function updateEvent(UserEventUpdateRequest $request, User $user)
    {

        $ue = (new UserEventService($user))->createEvent($request->validated() + ['action_user_id' => Auth::user()->id]);

        return ResponseFormatter::success($ue, 'User event created succesfully');

    }
}
