<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->string('transaction_id', 64)->nullable();
            $table->integer('complaint_type_id')->index('complaints_complain_types_id_fk');
            $table->text('user_complaint_description')->nullable();
            $table->enum('complaint_status', ['PENDING', 'RESOLVED'])->default('PENDING');
            $table->text('admin_resolution_description')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->bigInteger('resolved_by')->nullable();
            $table->bigInteger('user_id')->index('complaint_users_id_fk_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaints');
    }
}
