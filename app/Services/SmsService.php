<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 13-Jul-21
 * Time: 1:53 AM
 */

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Http;

class SmsService implements UserVerificationInterface
{

    public function __construct()
    {
        $this->baseUrl = env('TWILIO_BASE_URL');

    }


    function sendVerificationCode(User $user)
    {

        $response = Http::post($this->baseUrl, [
            'name' => 'Steve',
            'role' => 'Network Administrator',
        ]);


    }


    function verifyCode($code)
    {



    }

}