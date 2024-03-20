<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 10-Feb-22
 * Time: 11:32 PM
 */

namespace App\Services;


use App\Enums\UserType;
use App\Models\User;

/*Factory used to determine which wallet to consider for a user*/
/*Agents have different wallets i.e funds and commission hence placed in different tables and need different services*/

/*Both WalletService and AgentWalletService share similar credit,debit and available balance methods*/

class WalletServiceFactory
{

    function getWalletServiceFactory(User $user)
    {
        if ($user->user_type_id == UserType::Agent)
            return new AgentWalletService($user->agent->agentWallets->where('wallet_type', 'FUNDS')->first());

        return new WalletService($user->wallet);

    }

}