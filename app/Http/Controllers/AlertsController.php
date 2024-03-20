<?php

namespace App\Http\Controllers;

use App\Enums\NotificationEntities;
use App\Enums\UserType;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\CreateAlertRequest;
use App\Models\NotificationLog;
use App\Models\User;
use App\Services\PushNotificationService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlertsController extends Controller
{
    function sendAlert(CreateAlertRequest $request)
    {
        $this->validate($request, [
            'user_type_id' => 'nullable|required_without:user_id|in:2,3,4,0',
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'nullable|required_without:user_type_id'
        ]);

        if (isset($request->user_type_id))
            if ($request->user_type_id == 0)    /*Bulk send to all user type*/
                $ids = User::select('id')->get()->pluck('id')->toArray();
            else                                /*Bulk send to specific user type*/
                $ids = (new UserService())->getUserIdsByUserType($request->user_type_id);

        if (isset($request->user_id))   /*Send to specific user*/
            $ids = $request->user_id;

        $entityData = ['entity' => NotificationEntities::GENERAL, 'entity_event' => 'Admin_notification'];

        (new PushNotificationService())->sendFirebasePushNotification($request->title, $request->body, $ids, $entityData);

        return ResponseFormatter::success([], 'Bulk push notifications sent success');
    }


    function indexNotificationLog(Request $request)
    {

        $logs = NotificationLog::with('user:id,username,first_name,last_name,pacpay_user_id,mobile_no,user_type_id','walletTransaction')
            ->byUser(Auth::user())
            ->filter($request->all())
            ->latest('id');

        if ($request->request_origin == 'web')
            return datatables($logs)->toJson();

        return ResponseFormatter::success($logs->paginate($request->per_page), 'Notifications log lists');
    }
}
