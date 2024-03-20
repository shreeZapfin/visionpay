<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class MonthtlyDepositLimitBreachedException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([],'Monthly deposit limit breached',400,1425);

    }
}
