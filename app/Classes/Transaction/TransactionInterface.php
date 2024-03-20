<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 11:44 PM
 */

namespace App\Classes\Transaction;


interface TransactionInterface
{
    function get_transaction_details(): array;
}