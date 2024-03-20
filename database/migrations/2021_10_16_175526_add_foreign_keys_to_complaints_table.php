<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->foreign('complaint_type_id', 'complaints_complain_types_id_fk')->references('id')->on('complaint_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('transaction_id', 'complaints_wallet_transactions_transaction_id_fk')->references('transaction_id')->on('wallet_transactions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id', 'complaints_users_id_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropForeign('complaints_complain_types_id_fk');
            $table->dropForeign('complaints_wallet_transactions_transaction_id_fk');
            $table->dropForeign('complaints_users_id_fk');
        });
    }
}
