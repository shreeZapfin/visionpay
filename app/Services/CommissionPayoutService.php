<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 01-Sep-21
 * Time: 9:15 PM
 */

namespace App\Services;


use App\Classes\Transaction\TransactionFactory;
use App\Enums\WalletTransactionType;
use App\Exceptions\InsufficientWalletBalanceException;
use App\Helpers\Utils;
use App\Models\AgentWallet;
use App\Models\CommissionPayout;
use Illuminate\Support\Facades\DB;

class CommissionPayoutService
{

    function createPayout($arr)
    {

        return CommissionPayout::create($arr + ['payout_id' => 'PO' . Utils::transaction_id_generator()]);

    }


    function payoutCommission($arr)
    {

        /*Create payout*/
        /*debit agent comm wallet*/

        /*IF payout is wallet
         credit agent fund wallet
         */
        $payout = new CommissionPayout();

        DB::transaction(function () use ($arr,&$payout) {
            $payout = $this->createPayout($arr);


            if($arr['payout_type'] =='WALLET')
                $txnType = WalletTransactionType::COMMISSION_WALLET_PAYOUT;
            else
                $txnType = WalletTransactionType::COMMISSION_CASH_PAYOUT;


            $agentWallet = AgentWallet::where(['agent_id' => $payout->agent_id, 'wallet_type' => 'COMMISSION'])->first();

            $agentWalletService = new AgentWalletService($agentWallet);

            if (!$agentWalletService->is_wallet_balance_sufficient($arr['amount']))
                throw new InsufficientWalletBalanceException();

            $transactionType = (new TransactionFactory($payout))->get_transaction_type($txnType);

            $agentWalletService->debit_wallet($transactionType->get_transaction_details());

            if($arr['payout_type'] =='WALLET')
            {
                $agentFundsWallet =  AgentWallet::where(['agent_id' => $payout->agent_id, 'wallet_type' => 'FUNDS'])->first();

                $agentFundsWalletService = new AgentWalletService($agentFundsWallet);

                $agentFundsWalletService->credit_wallet($transactionType->get_transaction_details());

            }

        });

        return $payout;

    }


}