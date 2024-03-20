<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class FundRequestStatus extends Enum
{
    const ACCEPTED = 'ACCEPTED';
    const REJECTED = 'REJECTED';
    const REQUESTED = 'REQUESTED';
}
