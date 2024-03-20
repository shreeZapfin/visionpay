<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->integer('id', true);
            $table->string('promotion_name', 64);
            $table->string('promotion_model', 32)->index();
            $table->enum('promotion_transaction_type', ['WALLET_TRANSFER', 'RECHARGE','DEPOSIT','WITHDRAWAL','PAYMENT','BILL_PAYMENT','WITHDRAWAL_CHARGE','ADMIN_WALLET_REFILL'])->index();
            $table->unsignedBigInteger('voucher_id')->index('promotions_vouchers_id_fk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
