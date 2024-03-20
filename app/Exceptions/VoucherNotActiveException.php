<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class VoucherNotActiveException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([], 'Voucher not active', 400, 1461);
    }
}
