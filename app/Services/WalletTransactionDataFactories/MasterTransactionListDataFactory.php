<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 03-Sep-21
 * Time: 2:10 AM
 */

namespace App\Services\WalletTransactionDataFactories;


use App\Models\WalletTransaction;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MasterTransactionListDataFactory implements WalletTransactionDataInterface
{

    function getData($walletTransactionQuery, $filters)
    {

//        dd($filters);

        $wallet =
            DB::table('wallet_transactions')
                ->from('wallet_transactions as wt1')
                ->join("wallet_transactions as wt2", function ($join) {
                    $join->whereColumn("wt1.transaction_type", "=", "wt2.transaction_type")
                        ->whereColumn("wt1.transaction_id","=","wt2.transaction_id")
                        ->whereColumn("wt1.user_id", "<>", "wt2.user_id")
                        ->where("wt2.credit_amount", ">", 0);
                })
                ->join("users as sender_user", function ($join) {
                    $join->on("sender_user.id", "=", "wt1.user_id");
                })
                ->join("users as receiver_user", function ($join) {
                    $join->on("receiver_user.id", "=", "wt2.user_id");
                })->selectRaw("wt1.created_at,wt1.description, wt1.transaction_id, wt1.transaction_type,
             if (wt1.transaction_type = 'wallet_transfer',
                if(sender_user.user_type_id = 2 and receiver_user.user_type_id = 4, 'p2b', 'p2p')
             , wt1.transaction_type) as transfer_type,
             if (wt1.debit_amount = 0, wt1.credit_amount, wt1.debit_amount) as amount,
              sender_user.username as sender_username, wt1.opening_balance as sender_opening, wt1.closing_balance as sender_closing,
              receiver_user.username as receiver_username, wt2.opening_balance as receiver_opening, wt2.closing_balance as receiver_closing")
                ->whereDate('wt1.created_at', '>=', $filters['from_date'])
                ->whereDate('wt1.created_at', '<=', $filters['to_date'])
                ->where("wt1.debit_amount", ">", 0);


        $agentWalletTxnData = DB::table('wallet_transactions')
            ->from('wallet_transactions as wt1')
            ->join("agent_wallet_transactions as wt2", function ($join) {
                $join->on("wt1.transaction_type", "=", "wt2.transaction_type")
                    ->where("wt1.transaction_id","wt2.transaction_id");
            })
            ->join("users as sender_user", function ($join) {
                $join->on("sender_user.id", "=", "wt1.user_id");
            })
            ->join("agent_wallets as a", function ($join) {
                $join->on("wt2.agent_wallet_id", "=", "a.id");
            })
            ->join("agents", function ($join) {
                $join->on("a.agent_id", "=", "agents.id");
            })
            ->join("users as receiver_user", function ($join) {
                $join->on("receiver_user.id", "=", "agents.user_id");
            })
            ->selectRaw("wt1.created_at,wt1.description,wt1.transaction_id,wt1.transaction_type
            ,wt1.transaction_type as transfer_type,if (wt1.debit_amount = 0, wt1.credit_amount, wt1.debit_amount) as amount
            ,sender_user.username as sender_username,wt1.opening_balance as sender_opening,wt1.closing_balance as sender_closing,
            receiver_user.username as receiver_username,wt2.opening_balance as receiver_opening,wt2.closing_balance as receiver_closing")
            ->whereDate('wt1.created_at', '>=', $filters['from_date'])
            ->whereDate('wt1.created_at', '<=', $filters['to_date']);


        return $wallet->get()->merge($agentWalletTxnData->get());

    }


}