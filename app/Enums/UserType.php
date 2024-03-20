<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class UserType extends Enum
{
    const Admin = 1;
    const Customer = 2;
    const Agent = 3;
    const Merchant = 4;
    const Biller = 5;
    const AdminCommission = 6;
    const SubAccount = 7;
    const AdminWithdrawal = 8;
    const Staff=9;

    static function StaffTypes(){
        return [ self::Admin,self::Staff,self::Agent ];
    }


    static function UniqueAdminTypes(){
        return [ self::Admin,self::AdminCommission,self::AdminWithdrawal ];
    }
}
