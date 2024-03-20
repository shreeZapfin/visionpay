<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->foreign('agent_id', 'deposits_FK')->references('id')->on('agents')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id', 'deposits_FK_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->dropForeign('deposits_FK');
            $table->dropForeign('deposits_FK_1');
        });
    }
}
