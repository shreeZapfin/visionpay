<?php

namespace App\Providers;

use App\Enums\WalletTransactionType;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //ADD MODELS ADDED TO WALLET TRANSACTIONS HERE
        Relation::morphMap([
            WalletTransactionType::WALLET_TRANSFER => 'App\Models\FundRequest',
            WalletTransactionType::DEPOSIT => 'App\Models\Deposit',
            WalletTransactionType::DEPOSIT_COMMISSION => 'App\Models\Deposit',
            WalletTransactionType::WITHDRAWAL => 'App\Models\Withdrawal',
            WalletTransactionType::WITHDRAWAL_CHARGE => 'App\Models\Withdrawal',
            WalletTransactionType::WITHDRAWAL_COMMISSION => 'App\Models\Withdrawal',
            WalletTransactionType::BILL_PAYMENT => 'App\Models\BillPayment',
            WalletTransactionType::CASHBACK => 'App\Models\WalletTransaction',
            WalletTransactionType::BILL_PAYMENT_CHARGE => 'App\Models\BillPayment',
            WalletTransactionType::WITHDRAWAL_CHARGE_REFUND => 'App\Models\Withdrawal',
            WalletTransactionType::WITHDRAWAL_REFUND => 'App\Models\Withdrawal',
            WalletTransactionType::MERCHANT_PAYMENT_CHARGE => 'App\Models\FundRequest',
            WalletTransactionType::P2P_PAYMENT_CHARGE => 'App\Models\FundRequest',
        ]);
    }
}
