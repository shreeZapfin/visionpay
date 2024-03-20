<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('city_id', 'users_cities_id_fk')->references('id')->on('cities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('wallet_id', 'users_FK')->references('id')->on('wallets')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_type_id', 'users_user_types_id_fk')->references('id')->on('user_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('transfer_limit_scheme_id', 'users_limit_id_fk')->references('id')->on('transfer_limit_schemes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('commission_scheme_id', 'users_scheme_id_fk')->references('id')->on('commission_schemes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_permission_id', 'users_permission_id_fk')->references('id')->on('user_permissions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('master_account_user_id', 'users_master_user_id_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_cities_id_fk');
            $table->dropForeign('users_FK');
            $table->dropForeign('users_user_types_id_fk');
            $table->dropForeign('users_limit_id_fk');
            $table->dropForeign('users_scheme_id_fk');
            $table->dropForeign('users_permission_id_fk');
            $table->dropForeign('users_master_user_id_fk');
        });
    }
}
