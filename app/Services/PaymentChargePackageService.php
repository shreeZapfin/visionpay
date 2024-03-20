<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 14-Jan-22
 * Time: 3:43 AM
 */

namespace App\Services;


use App\Classes\Transaction\PaymentChargeOnTransaction;
use App\Enums\ChargePackageType;
use App\Enums\UserType;
use App\Enums\WalletTransactionType;
use App\Models\PaymentChargePackage;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;

class PaymentChargePackageService
{

    function getDefaultPackgeByUserType(User $user)
    {
        if($user->user_type_id == UserType::SubAccount) {   /*Get master account user incase of a sub account and apply same package for this user*/
            $user = $user->master_account()->first();
        }
        switch ($user->user_type_id) {
            case UserType::Customer :
                return PaymentChargePackage::where('package_type', ChargePackageType::P2P)->where('is_default', true)->first()->id;
                break;
            case UserType::Agent :
                return null;
                break;
            case UserType::Merchant : /*A merchant can also transfer to a customer hence a p2p scheme has to be applied*/
                return PaymentChargePackage::whereIn('package_type', [ChargePackageType::MERCHANT, ChargePackageType::P2P])->where('is_default', true)->pluck('id');
                break;
            case UserType::Biller :
                return PaymentChargePackage::where('package_type', ChargePackageType::BILL)->where('is_default', true)->first()->id;
                break;
            default :
                return null;
        }
    }

    function assignUserDefaultPaymentChargePackage(User $user)
    {
        $user->paymentChargePackage()->attach($this->getDefaultPackgeByUserType($user));
    }


    function assignUserPaymentChargePackage(User $user, PaymentChargePackage $package)
    {
        if ($this->validateUserTypeToPackage($user, $package)) {
            $currentPackageIdForType = $user->paymentChargePackage()->where('package_type', $package->package_type);
            if ($currentPackageIdForType->pluck('payment_charge_package_id')->isNotEmpty())
                $user->paymentChargePackage()->detach(['payment_charge_package_id' => $currentPackageIdForType->pluck('payment_charge_package_id')]);
            $user->paymentChargePackage()->attach([$package->id]);
        } else
            throw new \Exception('Invalid user type assigned to package', 400);
    }

    function validateUserTypeToPackage($user, $package)
    {
        if($user->user_type_id == UserType::SubAccount) {   /*Get master account user incase of a sub account and apply same package for this user*/
            $user = $user->master_account()->first();
        }

        if ($user->user_type_id == UserType::Biller AND $package->package_type != ChargePackageType::BILL)
            return false;
        if ($user->user_type_id == UserType::Customer AND $package->package_type != ChargePackageType::P2P)
            return false;
        if ($user->user_type_id == UserType::Merchant AND !in_array($package->package_type, [ChargePackageType::P2P, ChargePackageType::MERCHANT]))
            return false;
        return true;

    }


    function getPackageChargeTypeFromTransactionType(WalletTransaction $transaction)
    {
        switch ($transaction) {

            case WalletTransactionType::WALLET_TRANSFER :


                break;

            case WalletTransactionType::BILL_PAYMENT :

                return ChargePackageType::BILL;

        }


    }


    function deductPaymentChargeForWalletTxn(WalletTransaction $walletTransaction)
    {
        DB::transaction(function () use ($walletTransaction) {
            $user = $walletTransaction->user;
            $user->load(['paymentChargePackage' => function ($q) use ($walletTransaction) {
                $q->where('package_type', (new WalletTransactionService())->get_type_of_wallet_transfer($walletTransaction));
            }]);

            if ($user->paymentChargePackage->isEmpty())
                return;

            $charge = $user->paymentChargePackage[0]->charges; /*Array casted in paymentChargePackage Model*/

            if ($charge['payment_charges']['percentage_charge'] == 0) /*If no charge dont create any charge entry*/
                return;

            $chargeTxnObj = (new PaymentChargeOnTransaction($walletTransaction, $user->paymentChargePackage[0]));
            $userWallet = $user->wallet;

            $chargeTxnDetails = $chargeTxnObj->get_transaction_details();

            /*Debit charge*/
            (new WalletService($userWallet))->debit_wallet($chargeTxnDetails);

            /*Credit charge to admin commission*/
            $adminCommWallet = Wallet::whereHas('user', function ($query) {
                $query->where('user_type_id', UserType::AdminCommission);
            })->first();

            (new WalletService($adminCommWallet))->credit_wallet($chargeTxnDetails);
        });

    }


    function calculate_payment_charge(PaymentChargePackage $package, $amount)
    {

        $charge = $package->charges;

        $percentCharge = $charge['payment_charges']['percentage_charge'] * $amount / 100;

        if ($percentCharge == 0)
            return $percentCharge; /*Dont charge*/

        if ($percentCharge < $charge['payment_charges']['min_charge'])
            return $charge['payment_charges']['min_charge'];
        if ($percentCharge > $charge['payment_charges']['max_charge'])
            return $charge['payment_charges']['max_charge'];

        return $percentCharge;
    }

}