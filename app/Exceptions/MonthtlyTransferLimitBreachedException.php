<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class MonthtlyTransferLimitBreachedException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([],'Monthly transfer limit breached',400,1422);

    }
}
