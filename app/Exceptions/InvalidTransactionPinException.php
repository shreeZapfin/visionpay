<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class InvalidTransactionPinException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([], 'Invalid transaction pin', 400, 1420);

    }
}
