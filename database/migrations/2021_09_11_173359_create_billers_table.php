<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->bigInteger('user_id')->nullable()->index('billers_users_id_fk_2');
            $table->string('biller_name', 256);
            $table->text('biller_img_url')->nullable();
            $table->json('biller_fields');
            $table->integer('biller_category_id');
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billers');
    }
}
