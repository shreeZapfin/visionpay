<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFundRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fund_requests', function (Blueprint $table) {
            $table->foreign('admin_bank_id', 'fund_requests_admin_bank_details_id_fk')->references('id')->on('admin_bank_details')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('sender_user_id', 'fund_requests_users_id_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('requester_user_id', 'fund_requests_users_id_fk_2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fund_requests', function (Blueprint $table) {
            $table->dropForeign('fund_requests_admin_bank_details_id_fk');
            $table->dropForeign('fund_requests_users_id_fk');
            $table->dropForeign('fund_requests_users_id_fk_2');

        });
    }
}
