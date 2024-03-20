<?php

namespace App\Http\Controllers;

use App\Events\UserEventCreated;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\UserEventUpdateRequest;
use App\Models\User;
use App\Models\UserEvent;
use App\Services\UserEventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEventController extends Controller
{
    function index(Request $request)
    {
        $ue = UserEvent::byUser(Auth::user())
            ->with(['user', 'actionUser'])
            ->filter($request->all())
            ->orderBy('id', 'DESC');


        if ($request->request_origin == 'web')
            return datatables($ue)->toJson();

        return ResponseFormatter::success($ue->paginate($request->per_page), 'User event list');

    }


    function updateEvent(UserEventUpdateRequest $request, User $user)
    {

        $ue = (new UserEventService($user))->createEvent($request->validated() + ['action_user_id' => Auth::user()->id]);

        return ResponseFormatter::success($ue, 'User event created succesfully');

    }
}
