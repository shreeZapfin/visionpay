<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->foreign('business_type_id', 'businesses_business_types_id_fk')->references('id')->on('business_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id', 'businesses_users_id_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('merchant_category_id', 'users_merchant_categories_id_fk')->references('id')->on('merchant_categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('businesses', function (Blueprint $table) {
            $table->dropForeign('businesses_business_types_id_fk');
            $table->dropForeign('users_merchant_categories_id_fk');
            $table->dropForeign('businesses_users_id_fk');
        });
    }
}
