<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\User;
use App\Services\TwilioOtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class OtpController extends Controller
{
    function sendOtp(Request $request)
    {

            $this->validate($request, [
                'auth_type' => 'required|in:mobile,email',
                'mobile_no' => 'required_if:auth_type,mobile|digits_between:7,10',
                'email' => 'required_if:auth_type,email',
                'otp_for' => 'in:USR_VER,USR_PWD,USR_PIN'
            ]);
        try {
            if ($request->auth_type == 'mobile')
                (new TwilioOtpService())->sendOtp($request->mobile_no);
            else
                (new TwilioOtpService())->sendOtpEmail($request->email);

            return ResponseFormatter::success([], 'Otp sent succesfully');
        } catch (\Exception $exception) {
            Log::error('Error in send otp request : ' . json_encode($request->all()) . ' | exception : ' . $exception);
            return ResponseFormatter::error([], 'Otp error ! Please try again', 500, 1510);
        }
    }

    function verifyOtp(Request $request)
    {
            $this->validate($request, [
                'auth_type' => 'required|in:mobile,email',
                'mobile_no' => 'required_if:auth_type,mobile|digits_between:7,10',
                'email' => 'required_if:auth_type,email',
                'otp' => 'required|digits:6',
                'otp_for' => 'in:USR_VER,USR_PWD,USR_PIN'
            ]);
        try {
            if($request->auth_type=='mobile')
                $otpIsValid = (new TwilioOtpService())->verifyOtp($request->otp, $request->mobile_no);
            else
                $otpIsValid = (new TwilioOtpService())->verifyOtpEmail($request->otp, $request->email);
            if ((App::environment() == 'testing' && $request->otp == '101101') || $otpIsValid) {
                if ($request->otp_for == 'USR_VER')
                    User::where('mobile_no', $request->mobile_no)->update(['is_verified' => true]);
                return ResponseFormatter::success([], 'Otp verified');
            } else
                return ResponseFormatter::error([], 'Invalid otp', 400, 1409);
        } catch (\Exception $exception) {
            Log::error('Error in verify otp request : ' . json_encode($request->all()) . ' | exception : ' . $exception);
            return ResponseFormatter::error([], 'Otp error ! Please try again', 500, 1510);
        }
    }
}
