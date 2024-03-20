<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Permissions extends Enum
{

    const VIEW_USER = 'VIEW_USER';
    const CREATE_USER = 'CREATE_USER';
    const MANAGE_USER_VERIFICATION = 'MANAGE_USER_VERIFICATION';
    const UPLOAD_USER_DOCUMENT = 'UPLOAD_USER_DOCUMENT';
    const EDIT_USER_BASIC_DETAILS = 'EDIT_USER_BASIC_DETAILS';
    const SEND_USER_NOTIFICATION = 'SEND_USER_NOTIFICATION';
    const MANAGE_USER_WALLET = 'MANAGE_USER_WALLET'; #This enum manages below functions
    /*  send funds
        block account
        block wallet
        View fund request
        Accept/reject fund request
        Bank Withdrawal accept/reject
        Biller withdrawal
    */


    const MANAGE_COMPLAINT = 'MANAGE_COMPLAINT';
    /*
     * view complaints
     * create complaint
     * manage complaint i.e chat with customer
    */
    const MANAGE_ADVERTISEMENT = 'MANAGE_ADVERTISEMENT';
    /*
     * create advertisments
     * manage advertisments i.e remove/add advertismnet
  */

}
