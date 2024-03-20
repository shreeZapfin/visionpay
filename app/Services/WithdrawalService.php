<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 16-Aug-21
 * Time: 3:54 AM
 */

namespace App\Services;


use App\Classes\Transaction\TransactionFactory;
use App\Enums\UserType;
use App\Enums\WalletTransactionType;
use App\Enums\WithdrawalStatus;
use App\Exceptions\DailyWithdrawalLimitBreachedException;
use App\Exceptions\InsufficientWalletBalanceException;
use App\Exceptions\InsufficientWithdrawalableBalanceException;
use App\Exceptions\MonthtlyDepositLimitBreachedException;
use App\Exceptions\WithdrawalRequestExpiredException;
use App\Helpers\Utils;
use App\Models\AgentWallet;
use App\Models\Bank;
use App\Models\Deposit;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\UserBank;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class WithdrawalService
{
    function intiateWithdrawal($arr)
    {
        /*check withdrawal limit today*/
        /*check available user wallet balance with charge*/
        /*Add withdrawal entry for intiatisation*/

        $this->checkDailyWithdrawableLimitBreached($arr['user_id'], $arr['amount'], $arr['wdType']);

        if ($this->checkUserAvailableBalance($arr['user_id'], $arr['amount'], $arr['wdType'])) {
            $withdrawal = $this->createWithdrawal([
                'agent_id' => isset($arr['agent_id']) ? $arr['agent_id'] : null,
                'user_id' => $arr['user_id'],
                'amount' => $arr['amount'],
                'withdrawal_id' => 'WT' . Utils::transaction_id_generator(),
                'expires_at' => now()->addMinutes(5),
                'bank_details' => isset($arr['user_bank_id']) ? UserBank::find($arr['user_bank_id'])->getBankDetailsArr() : null,
                'status' => $arr['status'],
                'is_bank_withdrawal' => $arr['is_bank_withdrawal']
            ]);

            return $withdrawal;
        }
    }


    function acceptWithdrawal(Withdrawal $withdrawal)
    {
        /*check expiry time*/
        /*check available user wallet balance with charge*/
        /*Add user wallet transaction*/
        /*add user wallet charge transaction*/
        /*add admin agent commission wallet charge transaction*/
        /*Add agent wallet transaction*/
        /*Issue commission to agent*/

        $withdrawal->append('is_expired');
        if ($withdrawal->is_expired) {
            $withdrawal->status = WithdrawalStatus::EXPIRED;
            $withdrawal->save();
            throw new WithdrawalRequestExpiredException();
        }

        $this->checkDailyWithdrawableLimitBreached($withdrawal->user_id, $withdrawal->amount, $withdrawal->getWdType());

        if ($this->checkUserAvailableBalance($withdrawal->user_id, $withdrawal->amount, $withdrawal->getWdType())) {

            DB::transaction(function () use ($withdrawal) {

                $userWallet = $withdrawal->user->wallet;
                $userWalletService = (new WalletService($userWallet));

                $transactionType = (new TransactionFactory($withdrawal))->get_transaction_type(WalletTransactionType::WITHDRAWAL);

                $agentWallets = AgentWallet::where(['agent_id' => $withdrawal->agent_id])->get();
                $agentWalletService = (new AgentWalletService($agentWallets->where('wallet_type', 'FUNDS')->first()));

                /*Debit customers wallet*/
                $userWalletService->debit_wallet($transactionType->get_transaction_details());

                /*Credit agents wallet*/
                $agentWalletService->credit_wallet($transactionType->get_transaction_details());

                /*Debit customers wallet for withdrawal charge*/
                $withdrawalChargeTransaction = (new TransactionFactory($withdrawal))->get_transaction_type(WalletTransactionType::WITHDRAWAL_CHARGE);
                $userWalletService->debit_wallet($withdrawalChargeTransaction->get_transaction_details());

                /*credit the charge to admin commission wallet*/
                $adminCommWallet = Wallet::whereHas('user', function ($query) {
                    $query->where('user_type_id', UserType::AdminCommission);
                })->first();

                (new WalletService($adminCommWallet))->credit_wallet($withdrawalChargeTransaction->get_transaction_details());

                /*Credit agents commission wallet for withdrawal commission*/
                $withdrawalCommissionTransaction = (new TransactionFactory($withdrawal))->get_transaction_type(WalletTransactionType::WITHDRAWAL_COMMISSION);
                $agentCommissionWalletService = (new AgentWalletService($agentWallets->where('wallet_type', 'COMMISSION')->first()));
                $agentCommissionWalletService->credit_wallet($withdrawalCommissionTransaction->get_transaction_details());

                $withdrawal->status = WithdrawalStatus::ACCEPTED;
                $withdrawal->save();

            });

        }

        return $withdrawal;
    }


    function createWithdrawToBankRequest($arr)
    {

        $withdrawal = DB::transaction(function () use ($arr) {
            $withdrawal = $this->intiateWithdrawal($arr);


            $userWalletService = (new WalletServiceFactory())->getWalletServiceFactory($withdrawal->user);

            $adminWallet = Wallet::whereHas('user', function ($query) {
                $query->where('user_type_id', UserType::AdminWithdrawal);
            })->first();

            $transactionType = (new TransactionFactory($withdrawal))->get_transaction_type(WalletTransactionType::WITHDRAWAL);

            /*Debit customers wallet for withdrawal amount*/
            $userWalletService->debit_wallet($transactionType->get_transaction_details());

            (new WalletService($adminWallet))->credit_wallet($transactionType->get_transaction_details());


            /*Debit customers wallet for withdrawal charge*/
            $withdrawalChargeTransaction = (new TransactionFactory($withdrawal))->get_transaction_type(WalletTransactionType::WITHDRAWAL_CHARGE);
            $userWalletService->debit_wallet($withdrawalChargeTransaction->get_transaction_details());

            /*credit the charge to admin commission wallet*/
            $adminCommWallet = Wallet::whereHas('user', function ($query) {
                $query->where('user_type_id', UserType::AdminCommission);
            })->first();

            (new WalletService($adminCommWallet))->credit_wallet($withdrawalChargeTransaction->get_transaction_details());


            return $withdrawal;
        });

        return $withdrawal;

    }

    function createWithdrawal($arr)
    {
        return Withdrawal::create($arr);
    }


    function getWithdrawal($filters)
    {
        return Withdrawal::filter($filters);
    }

    function getWithdrawalCharge($withdrawalType, $amount)
    {
        $withdrawalCharges = SystemSetting::first()->withdrawal_charges;

        $percentCharge = $withdrawalCharges[$withdrawalType]['percentage_charge'] * $amount / 100;

        if ($percentCharge < $withdrawalCharges[$withdrawalType]['min_charge'])
            return $withdrawalCharges[$withdrawalType]['min_charge'];
        if ($percentCharge > 10.00)
            return $withdrawalCharges[$withdrawalType]['max_charge'];

        return $percentCharge;

    }

    function getWithdrawalCommission($amount)
    {

        $withdrawalCommissionsRanges = SystemSetting::first()->withdrawal_commission_tiers;

        foreach ($withdrawalCommissionsRanges['withdrawal_ranges'] as $range) {
            if (($range['min_range'] <= $amount) && ($amount <= $range['max_range']))
                $commAmount = $range['commission'];
        }

        return $commAmount;

    }

    function checkDailyWithdrawableLimitBreached($userId, $amount)
    {

        $setting = SystemSetting::first();
        $minWithdrawLimit = $setting->min_withdrawal_limit;

        if ($amount < $minWithdrawLimit)
            throw new DailyWithdrawalLimitBreachedException('Min withdrawal balance is ' . $minWithdrawLimit);

        $amountWithdrawnToday = Withdrawal::where(['user_id' => $userId, 'status' => WithdrawalStatus::ACCEPTED])
            ->whereDate('created_at', today()->toDateString())
            ->sum('amount');

        $totalWithDrawnToday = $amountWithdrawnToday + $amount;

        $dailyWithdrawalLimit = $setting->daily_withdrawal_limit;

        if ($totalWithDrawnToday > $dailyWithdrawalLimit)
            throw new DailyWithdrawalLimitBreachedException('User daily withdrawal limit breached ! Limit left today : ' . ($dailyWithdrawalLimit - $amountWithdrawnToday));

        return false;
    }

    function checkUserAvailableBalance($userId, $amount, $wdType = null)
    {
        $user = User::find($userId);
        $walletService = (new WalletServiceFactory())->getWalletServiceFactory($user);

        $withdrawalTxnAmount = $amount + (($wdType) ? $this->getWithdrawalCharge($wdType, $amount) : 0);

        if (!$walletService->is_wallet_balance_sufficient($withdrawalTxnAmount))
            throw new InsufficientWithdrawalableBalanceException('Insufficient withdrawable user balance ! Available user balance : ' . $walletService->get_wallet_balance() . ' | Transaction amount = ' . $withdrawalTxnAmount);

        return true;
    }


    function processBankWithdrawal(Withdrawal $withdrawal, $arr)
    {


        $withdrawal = DB::transaction(function () use ($withdrawal, $arr) {
            /*If status : BANK_WITHDRAWAL_PAID*/
            /*update bank txn number*/
            if ($arr['status'] == WithdrawalStatus::BANK_WITHDRAWAL_PAID) {
//                $withdrawal->update(['bank_details->bank_reference_no' => $arr['bank_reference_no']]);
                Withdrawal::where('withdrawal_id', $withdrawal->withdrawal_id)->update(['bank_details->bank_reference_no' => $arr['bank_reference_no']]);
                $withdrawal->load('transaction');
                $withdrawal->transaction[0]->description .= ' | bank ref : ' . $arr['bank_reference_no'];
                $withdrawal->transaction[0]->save();
            } else {
                /*If status : BANK_WITHDRAWAL_FAILED*/
                /*Refund withdrawal to user wallet*/
                /*Refund charges on withdrawal*/

                $userWalletService = (new WalletServiceFactory())->getWalletServiceFactory($withdrawal->user);

                $adminWallet = Wallet::whereHas('user', function ($query) {
                    $query->where('user_type_id', UserType::AdminWithdrawal);
                })->first();


                $transactionType = (new TransactionFactory($withdrawal))->get_transaction_type(WalletTransactionType::WITHDRAWAL_REFUND);

                /*credit customers wallet for withdrawal refund amount*/
                $userWalletService->credit_wallet($transactionType->get_transaction_details());

                (new WalletService($adminWallet))->debit_wallet($transactionType->get_transaction_details());


                /*Credit customers wallet for withdrawal charge refund*/
                $withdrawalChargeRefundTransaction = (new TransactionFactory($withdrawal))->get_transaction_type(WalletTransactionType::WITHDRAWAL_CHARGE_REFUND);
                $userWalletService->credit_wallet($withdrawalChargeRefundTransaction->get_transaction_details());

                /*debit the charge from admin commission wallet*/
                $adminCommWallet = Wallet::whereHas('user', function ($query) {
                    $query->where('user_type_id', UserType::AdminCommission);
                })->first();

                (new WalletService($adminCommWallet))->debit_wallet($withdrawalChargeRefundTransaction->get_transaction_details());

            }

            $withdrawal->status = $arr['status'];
            $withdrawal->remark = $arr['remark'];
            $withdrawal->save();
            return $withdrawal;

        });

        return $withdrawal;
    }

    function adminWithdrawal(User $user, $amount, $remark)
    {
        if ((new WithdrawalService())->checkUserAvailableBalance($user->id, $amount)) {
            $withdrawal = DB::transaction(function () use ($user, $amount, $remark) {
                $withdrawal = (new WithdrawalService())->createWithdrawal([
                    'agent_id' => null,
                    'user_id' => $user->id,
                    'amount' => $amount,
                    'withdrawal_id' => 'WT' . Utils::transaction_id_generator(),
                    'expires_at' => null,
                    'bank_details' => null,
                    'status' => WithdrawalStatus::ADMIN_WITHDRAWAL,
                    'is_bank_withdrawal' => false,
                    'remark' => $remark
                ]);

                $userWalletService = (new WalletServiceFactory())->getWalletServiceFactory($user);

                $adminWallet = Wallet::whereHas('user', function ($query) {
                    $query->where('user_type_id', UserType::AdminWithdrawal);
                })->first();

                $transactionType = (new TransactionFactory($withdrawal))->get_transaction_type(WalletTransactionType::WITHDRAWAL);

                /*Debit customers wallet for withdrawal amount*/
                $userWalletService->debit_wallet($transactionType->get_transaction_details());

                (new WalletService($adminWallet))->credit_wallet($transactionType->get_transaction_details());


                return $withdrawal;

            });

            return $withdrawal;
        }
    }


}