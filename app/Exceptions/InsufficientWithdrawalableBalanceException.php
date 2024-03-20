<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use App\Services\WalletService;
use Exception;

class InsufficientWithdrawalableBalanceException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([],$this->getMessage(),400,1426);
    }
}
