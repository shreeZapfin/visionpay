<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->decimal('opening_balance', 10);
            $table->decimal('closing_balance', 10);
            $table->decimal('credit_amount', 10)->default(0.00);
            $table->decimal('debit_amount', 10)->default(0.00);
            $table->string('transaction_id', 64)->index('wallet_transactions_fund_requests_fund_request_id_fk');
            $table->enum('transaction_type', [
                'WALLET_TRANSFER',
                'DEPOSIT',
                'WITHDRAWAL',
                'BILL_PAYMENT',
                'WITHDRAWAL_CHARGE',
                'ADMIN_WALLET_REFILL',
                'CASHBACK',
                'P2P_PAYMENT_CHARGE',
                'MERCHANT_PAYMENT_CHARGE',
                'BILL_PAYMENT_CHARGE',
                'WITHDRAWAL_CHARGE_REFUND',
                'WITHDRAWAL_REFUND',
                'WALLET_TRANSFER_REFUND',
                'DEPOSIT_REFUND',
                'BILL_PAYMENT_REFUND',
                'ADMIN_WALLET_REFILL_REFUND',
                'CASHBACK_REFUND',
                'P2P_PAYMENT_CHARGE_REFUND',
                'MERCHANT_PAYMENT_CHARGE_REFUND',
                'BILL_PAYMENT_CHARGE_REFUND',
            ]);
            $table->bigInteger('user_id')->index('wallet_transactions_users_id_fk');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->string('description', 512)->nullable();
        });


        DB::statement('ALTER TABLE pacpay.wallet_transactions ADD CONSTRAINT wallet_transactions_check CHECK (opening_balance + credit_amount = closing_balance OR opening_balance - debit_amount = closing_balance);');
        DB::statement('ALTER TABLE pacpay.wallet_transactions ADD CONSTRAINT wallet_transactions_closing_balance_check CHECK (closing_balance >= 0.00);');
        DB::statement('ALTER TABLE pacpay.wallet_transactions ADD CONSTRAINT wallet_transactions_opening_balance_check CHECK (opening_balance >=0.00);');
        DB::statement('ALTER TABLE pacpay.wallet_transactions ADD CONSTRAINT wallet_transactions_credit_amount_check CHECK (credit_amount >=0.00);');
        DB::statement('ALTER TABLE pacpay.wallet_transactions ADD CONSTRAINT wallet_transactions_debit_amount_check CHECK (debit_amount >=0.00);');
        DB::statement('ALTER TABLE pacpay.wallet_transactions ADD CONSTRAINT wallet_transactions_un UNIQUE KEY (transaction_id,user_id,transaction_type);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_transactions');
    }
}
