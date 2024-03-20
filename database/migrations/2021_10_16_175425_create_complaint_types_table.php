<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_types', function (Blueprint $table) {
            $table->integer('id', true);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->text('type_description');
            $table->enum('transaction_type', ['GENERAL_COMPLAINT', 'WALLET_TRANSFER', 'RECHARGE', 'DEPOSIT', 'WITHDRAWAL', 'PAYMENT', 'BILL_PAYMENT', 'WITHDRAWAL_CHARGE', 'ADMIN_WALLET_REFILL', 'CASHBACK']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaint_types');
    }
}
