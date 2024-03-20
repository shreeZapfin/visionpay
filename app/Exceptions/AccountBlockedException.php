<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class AccountBlockedException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([],'You account is blocked !',400,1436);

    }
}
