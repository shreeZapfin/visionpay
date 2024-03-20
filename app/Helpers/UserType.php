<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 10-Jul-21
 * Time: 4:28 AM
 */

namespace App\Helpers;

abstract class UserType
{
    const Admin = 1;
    const Customer = 2;
    const Agent = 3;
    const Merchant = 4;
    const Biller =5;
}
