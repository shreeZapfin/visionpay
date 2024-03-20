<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class VoucherNotUsedAgainstValidUserException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([],'Voucher not used against valid user',400,1463);
    }
}
