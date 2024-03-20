<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 16-Aug-21
 * Time: 3:54 AM
 */

namespace App\Services;


use App\Classes\Transaction\TransactionFactory;
use App\Enums\WalletTransactionType;
use App\Exceptions\InsufficientWalletBalanceException;
use App\Exceptions\MonthtlyDepositLimitBreachedException;
use App\Helpers\Utils;
use App\Models\AgentWallet;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepositService
{
    function processDeposit($arr)
    {

        /*Check user deposit limit*/

        /*Add deposit entry*/

        /*Add user wallet transaction*/

        /*Add agent wallet transaction*/

        /*Issue commission to agent*/

        $user = User::find($arr['user_id']);
        $limitService = new DepositLimitService($user);

        if (($limitService->is_limit_breached_this_month($arr['amount'])))
            throw new MonthtlyDepositLimitBreachedException();

        $agentWallet = AgentWallet::where(['agent_id' => $arr['agent_id'], 'wallet_type' => 'FUNDS'])->first();

        $agentWalletService = new AgentWalletService($agentWallet);


        if (!$agentWalletService->is_wallet_balance_sufficient($arr['amount']))
            throw new InsufficientWalletBalanceException();


        DB::transaction(function () use ($agentWalletService, $user, $arr, &$deposit) {

            $deposit = $this->createDeposit([
                'agent_id' => $arr['agent_id'],
                'user_id' => $user->id,
                'amount' => $arr['amount'],
                'deposit_id' => 'DP' . Utils::transaction_id_generator()
            ]);

            $requesterUserWallet = $user->wallet;

            $requesterWalletService = (new WalletService($requesterUserWallet));

            $transactionType = (new TransactionFactory($deposit))->get_transaction_type(WalletTransactionType::DEPOSIT);

            $agentWalletService->debit_wallet($transactionType->get_transaction_details());
            $requesterWalletService->credit_wallet($transactionType->get_transaction_details());
        });

        return $deposit;
    }

    function createDeposit($arr)
    {
        return Deposit::create($arr);
    }


    function getDeposits($filters)
    {
        return Deposit::filter($filters);
    }


}