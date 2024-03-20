<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionUserVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_user_voucher', function (Blueprint $table) {
            $table->unsignedBigInteger('user_voucher_id')->nullable()->index('promotion_user_voucher_user_voucher_id_fk');
            $table->string('wallet_transaction_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_user_voucher');
    }
}
