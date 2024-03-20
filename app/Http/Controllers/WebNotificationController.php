<?php

namespace App\Http\Controllers;

use App\Services\PushNotificationService;
use Illuminate\Http\Request;
use App\Models\User;

class WebNotificationController extends Controller
{

    public function __construct()
    {
        //        $this->middleware('auth');
    }

    public function index()
    {
        return view('test_push_notification');
    }

    public function storeToken(Request $request)
    {
        auth()->user()->update(['device_key' => $request->token]);
        return response()->json(['Token successfully stored.']);
    }

    public function sendWebNotification(Request $request)
    {
        $FcmToken = User::whereNotNull('device_key')->pluck('device_key')->all();

        $result = (new PushNotificationService())->sendFirebasePushNotification($request->title, $request->body, $FcmToken);

        dd($result);
    }

    public function showAdminBankPage()
    {
        return view('Notification.notification_list');
    }
}
