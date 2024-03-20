<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 13-Jul-21
 * Time: 1:56 AM
 */

namespace App\Services;


use App\Models\User;

interface UserVerificationInterface
{

    function sendVerificationCode(User $user);

    function verifyCode($code);

}