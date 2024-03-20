<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAgentWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agent_wallet_transactions', function (Blueprint $table) {
//            $table->foreign('transaction_id', 'wallet_transactions_fund_requests_fund_request_id_fk')->references('fund_request_id')->on('fund_requests')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('agent_wallet_id', 'wallet_transactions_agent_wallets_agent_wallet_id_fk')->references('id')->on('agent_wallets')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
//            $table->dropForeign('wallet_transactions_fund_requests_fund_request_id_fk');

            $table->dropForeign('wallet_transactions_agent_wallets_agent_wallet_id_fk');
        });
    }
}
