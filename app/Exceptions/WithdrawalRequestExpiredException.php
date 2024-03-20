<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class WithdrawalRequestExpiredException extends Exception
{
    //

    function render()
    {
        return ResponseFormatter::error([],'The withdrawal request has expired ! Please ask agent for a new withdrawal !',400,1427);
    }
}
