<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class LoginTokenExistsException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([], 'Login token already exists ! Please login with otp to continue', 400, 1420);

    }
}
