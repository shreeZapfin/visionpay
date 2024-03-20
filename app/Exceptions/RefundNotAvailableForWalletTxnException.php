<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class RefundNotAvailableForWalletTxnException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([], 'Refund is not available for this type of wallet transaction', 400,1490);
    }
}
