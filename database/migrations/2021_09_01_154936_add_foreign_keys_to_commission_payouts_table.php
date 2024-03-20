<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCommissionPayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commission_payouts', function (Blueprint $table) {
            $table->foreign('agent_id', 'commission_payouts_agents_id_fk')->references('id')->on('agents')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commission_payouts', function (Blueprint $table) {
            $table->dropForeign('commission_payouts_agents_id_fk');
        });
    }
}
