<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class VoucherNotFoundException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([],'Voucher not found',400,1460);
    }
}
