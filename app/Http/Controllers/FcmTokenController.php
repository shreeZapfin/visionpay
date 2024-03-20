<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\FcmToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class FcmTokenController extends Controller
{
    function update(Request $request)
    {
        $this->validate($request, [
            'fcm_token' => 'required',
            'device_id' => 'required'
        ]);


        $token = Auth::user()->fcm_tokens()->updateOrCreate(['device_id' => $request->device_id], $request->all());

        return ResponseFormatter::success($token, 'Fcm token updated');

    }

    function delete(Request $request, FcmToken $fcmToken)
    {
        if (Auth::user()->id != $fcmToken->user_id)
            throw new UnauthorizedException();

        $fcmToken->delete();
        return ResponseFormatter::success([], 'Fcm deleted');
    }

}
