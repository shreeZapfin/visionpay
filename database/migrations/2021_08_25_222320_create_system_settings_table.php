<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_settings', function (Blueprint $table) {
//            $table->decimal('withdrawal_charge', 10)->default(2.00);
//            $table->decimal('withdrawal_min_charge', 10)->nullable()->default(2.00);
//            $table->decimal('withdrawal_max_charge', 10)->default(10.00);
            $table->json('withdrawal_charges');
            $table->json('withdrawal_commission_tiers');
            $table->tinyInteger('biller_transaction')->default(1);
            $table->tinyInteger('deposit')->default(1);
            $table->tinyInteger('fund_request')->default(1);
            $table->tinyInteger('withdrawal')->default(1);
            $table->decimal('monthly_customer_deposit_limit', 10)->default(5000.00);
            $table->decimal('monthly_merchant_deposit_limit', 10)->default(10000.00);
            $table->decimal('agent_deposit_commission', 10)->default(0.10);
            $table->decimal('daily_withdrawal_limit', 10)->default(2000.00);
            $table->decimal('min_withdrawal_limit', 10)->default(100.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_settings');
    }
}
