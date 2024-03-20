<?php

namespace App\Exceptions;

use App\Helpers\ResponseFormatter;
use Exception;
use Illuminate\Support\Facades\Log;

class ThirdPartyConnectionException extends Exception
{
    function report()
    {
        Log::error('Error in third party service  provider Exception : ' . $this);

    }


    function render()
    {
        return ResponseFormatter::error([], 'Error in TPP ! Please try again', 500, 1511);

    }
}
