<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class SubAccountLimitExceededException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([], 'Sub account limit exceeded', 400,1431);
    }
}
