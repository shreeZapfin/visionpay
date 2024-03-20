<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('business_name', 128)->nullable();
            $table->string('company_tin_no', 64)->nullable();
            $table->text('company_tin_img_url')->nullable();
            $table->text('company_reg_img_url')->nullable();
            $table->bigInteger('user_id')->index('businesses_users_id_fk');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->integer('business_type_id')->nullable()->index('businesses_business_types_id_fk');
            $table->integer('merchant_category_id')->nullable()->index('users_merchant_categories_id_fk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
