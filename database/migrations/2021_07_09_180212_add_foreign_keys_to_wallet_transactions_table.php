<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
//            $table->foreign('transaction_id', 'wallet_transactions_fund_requests_fund_request_id_fk')->references('fund_request_id')->on('fund_requests')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id', 'wallet_transactions_users_user_id_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');

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
            $table->dropForeign('wallet_transactions_users_user_id_fk');
        });
    }
}
