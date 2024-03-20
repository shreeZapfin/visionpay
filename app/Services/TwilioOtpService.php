<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 27-Jul-21
 * Time: 2:59 AM
 */

namespace App\Services;


use App\Exceptions\ThirdPartyConnectionException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class TwilioOtpService
{
    function sendOtp($mobileNo)
    {
        $digits = strlen($mobileNo);

        $countryCode = ($digits == 7) ? '+679' : '+91';

        try {
            $token = env("TWILIO_AUTH_TOKEN");
            $twilio_sid = env("TWILIO_SID");
            $twilio_verify_sid = env("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($countryCode . $mobileNo, "sms");

        } catch (\Exception $exception) {
            Log::error($exception);
            throw new ThirdPartyConnectionException();
        }
    }

    function verifyOtp($otp, $mobileNo)
    {
        $digits = strlen($mobileNo);

        $countryCode = ($digits == 7) ? '+679' : '+91';

        if (App::environment() != 'production' AND $otp == '101101')
            return true;


        try {
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $verification = $twilio->verify->v2->services($twilio_verify_sid)
                ->verificationChecks
                ->create($otp, array('to' => $countryCode . $mobileNo));
            if ($verification->valid) {
                return true;
            }

            return false;
        } catch (\Exception $exception) {
            throw new ThirdPartyConnectionException();
        }
    }

    function sendOtpEmail($email)
    {
        try {
            $token = env("TWILIO_AUTH_TOKEN");
            $twilio_sid = env("TWILIO_SID");
            $twilio_verify_sid = env("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($email, "email");

        } catch (\Exception $exception) {
            Log::error($exception);
            throw new ThirdPartyConnectionException();
        }
    }

    function verifyOtpEmail($otp, $email)
    {

        try {
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
            $verification = $twilio->verify->v2->services($twilio_verify_sid)
                ->verificationChecks
                ->create($otp,
                    ["to" => $email]
                );


            if ($verification->valid) {
                return true;
            }

            return false;
        } catch (\Exception $exception) {
            throw new ThirdPartyConnectionException();
        }

    }
}