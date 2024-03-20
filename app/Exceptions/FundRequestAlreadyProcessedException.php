<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;

class FundRequestAlreadyProcessedException extends Exception
{
    function render()
    {
        return ResponseFormatter::error([], 'Fund request is already processed', 400, 1421);
    }
}
