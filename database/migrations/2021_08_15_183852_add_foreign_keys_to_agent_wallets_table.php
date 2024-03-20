<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAgentWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agent_wallets', function (Blueprint $table) {
            $table->foreign('agent_id', 'agent_wallets_agents_id_fk')->references('id')->on('agents')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agent_wallets', function (Blueprint $table) {
            $table->dropForeign('agent_wallets_agents_id_fk');
        });
    }
}
