<?php

namespace App\Exceptions;


use App\Helpers\ResponseFormatter;
use Exception;

class WalletLimitBreachedException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([],'Wallet limit has been breached of recipient of this transaction',400,1434);
    }

}
