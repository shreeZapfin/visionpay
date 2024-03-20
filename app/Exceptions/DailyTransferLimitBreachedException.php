<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class DailyTransferLimitBreachedException extends Exception
{
    function render()
    {
       return ResponseFormatter::error([],'Daily transfer limit breached',400,1423);

    }
}
