<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class NotValidForBankWithdrawalException extends Exception
{
    function render()
    {

        return ResponseFormatter::error([],'Only bank withdrawal having requested status as BANK_WITHDRAWAL_REQUEST can be processed',400,142801);

    }
}
