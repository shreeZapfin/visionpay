<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_wallet_transactions', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->decimal('opening_balance', 10);
            $table->decimal('closing_balance', 10);
            $table->decimal('credit_amount', 10)->default(0.00);
            $table->decimal('debit_amount', 10)->default(0.00);
            $table->string('transaction_id', 64)->index('agent_wallet_transactions_fund_requests_fund_request_id_fk');
            $table->enum('transaction_type', ['DEPOSIT','WITHDRAWAL','DEPOSIT_COMMISSION','WITHDRAWAL_COMMISSION','TRANSFER_COMMISSION','WALLET_TRANSFER','COMMISSION_CASH_PAYOUT','COMMISSION_WALLET_PAYOUT','WITHDRAWAL_CHARGE', 'WITHDRAWAL_CHARGE_REFUND', 'WITHDRAWAL_REFUND']);
            $table->integer('agent_wallet_id')->index('agent_wallet_transactions_agent_wallet_id_fk');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->string('description', 512)->nullable();
        });


        DB::statement('ALTER TABLE pacpay.agent_wallet_transactions ADD CONSTRAINT agent_wallet_transactions_check CHECK (opening_balance + credit_amount = closing_balance OR opening_balance - debit_amount = closing_balance);');
        DB::statement('ALTER TABLE pacpay.agent_wallet_transactions ADD CONSTRAINT agent_wallet_transactions_closing_balance_check CHECK (closing_balance >= 0.00);');
        DB::statement('ALTER TABLE pacpay.agent_wallet_transactions ADD CONSTRAINT agent_wallet_transactions_opening_balance_check CHECK (opening_balance >=0.00);');
        DB::statement('ALTER TABLE pacpay.agent_wallet_transactions ADD CONSTRAINT agent_wallet_transactions_credit_amount_check CHECK (credit_amount >=0.00);');
        DB::statement('ALTER TABLE pacpay.agent_wallet_transactions ADD CONSTRAINT agent_wallet_transactions_debit_amount_check CHECK (debit_amount >=0.00);');
        DB::statement('ALTER TABLE pacpay.agent_wallet_transactions ADD CONSTRAINT agent_wallet_transactions_un UNIQUE KEY (transaction_id,agent_wallet_id,transaction_type);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_wallet_transactions');
    }
}
