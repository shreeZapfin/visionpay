<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->foreign('agent_id', 'withdrawal_agents_id_fk')->references('id')->on('agents')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id', 'withdrawal_users_id_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropForeign('withdrawal_agents_id_fk');
            $table->dropForeign('withdrawal_users_id_fk');
        });
    }
}
