<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBillPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_payments', function (Blueprint $table) {
            $table->foreign('biller_id', 'table_name_billers_id_fk')->references('id')->on('billers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id', 'table_name_users_id_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_payments', function (Blueprint $table) {
            $table->dropForeign('table_name_billers_id_fk');
            $table->dropForeign('table_name_users_id_fk');
        });
    }
}
