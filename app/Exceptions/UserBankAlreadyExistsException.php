<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class UserBankAlreadyExistsException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([],'User bank already exists',400,1440);

    }
}
