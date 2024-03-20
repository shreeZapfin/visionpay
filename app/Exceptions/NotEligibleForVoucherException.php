<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class NotEligibleForVoucherException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([], 'You are not eligible for this voucher code ! Please try again or try with different code', 400, 1462);
    }
}
