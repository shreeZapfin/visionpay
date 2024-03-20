<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 17-Aug-21
 * Time: 3:40 AM
 */

namespace App\Services;


use App\Classes\Transaction\TransactionFactory;
use App\Enums\WalletTransactionType;
use App\Models\AgentWallet;
use App\Models\Deposit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessDepositCommission
{

    function processCommission(Deposit $deposit)
    {

        try {
            DB::transaction(function () use ($deposit) {

                $agentWallet = AgentWallet::where(['agent_id' => $deposit->agent_id, 'wallet_type' => 'COMMISSION'])->first();

                $agentWalletService = new AgentWalletService($agentWallet);

                $transactionType = (new TransactionFactory($deposit))->get_transaction_type(WalletTransactionType::DEPOSIT_COMMISSION);

                $agentWalletService->credit_wallet($transactionType->get_transaction_details());

            });
            return true;
        } catch (\Exception $exception) {
            Log::error('Something went wrong in processing commissions for deposit : '.$deposit.' Exception :'.$exception);
            return false;
        }

    }


}