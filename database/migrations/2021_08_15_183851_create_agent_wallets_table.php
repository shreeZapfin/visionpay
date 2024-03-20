<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_wallets', function (Blueprint $table) {
            $table->integer('id', true);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->enum('wallet_type', ['FUNDS', 'COMMISSION','ADMIN_COMMISSION'])->nullable();
            $table->integer('agent_id')->index('agent_wallets_agents_id_fk');
            $table->decimal('balance', 10)->default(0.00);
            $table->decimal('blocked_balance', 10)->default(0.00);
            $table->decimal('wallet_limit', 10)->default(10000.00);
        });

        DB::statement('ALTER TABLE pacpay.agent_wallets ADD CONSTRAINT agent_wallets_un UNIQUE KEY (agent_id,wallet_type);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_wallets');
    }
}
