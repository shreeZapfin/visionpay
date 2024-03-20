<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class InsufficientWalletBalanceException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([],'Insufficient wallet balance',400,1424);

    }
}
