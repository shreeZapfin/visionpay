<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->decimal('balance', 10)->default(0.00);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->decimal('blocked_balance', 10)->default(0.00);
            $table->decimal('wallet_limit', 10)->default(10000.00);
        });

        DB::statement('ALTER TABLE pacpay.wallets ADD CONSTRAINT wallets_check CHECK (balance >= 0.00);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
