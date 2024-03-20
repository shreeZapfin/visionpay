<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class DailyWithdrawalLimitBreachedException extends Exception
{
    function render(){
        return ResponseFormatter::error([],$this->getMessage(),400,1429);
    }
}
