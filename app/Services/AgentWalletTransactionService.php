<?php

/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 21-Jul-21
 * Time: 1:15 AM
 */

namespace App\Services;


use App\Models\AgentWalletTransaction;

class AgentWalletTransactionService
{

    function create_wallet_transaction($arr)
    {
        return AgentWalletTransaction::create($arr);
    }

    function get_wallet_transactions($filter)
    {
        return AgentWalletTransaction::filter($filter);
    }
}
