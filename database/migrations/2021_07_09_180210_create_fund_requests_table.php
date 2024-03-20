<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_requests', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('requester_user_id')->index('fund_requests_users_id_fk_2');
            $table->bigInteger('sender_user_id')->index('fund_requests_users_id_fk');
            $table->decimal('amount', 10);
            $table->enum('status', ['ACCEPTED', 'REQUESTED', 'REJECTED'])->default('REQUESTED');
            $table->enum('request_type', ['DIRECT', 'REQUEST','AGENT_WALLET_REFILL'])->default('REQUEST');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->string('transaction_ref_no', 128)->nullable();
            $table->text('description')->nullable();
            $table->integer('admin_bank_id')->nullable()->index('fund_requests_admin_bank_details_id_fk');
            $table->string('fund_request_id', 32)->unique('fund_requests_fund_request_id_uindex');
            $table->tinyInteger('is_wallet_refill')->default(0);
            $table->text('reject_remark')->nullable();
            $table->boolean('is_sub_account_request')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fund_requests');
    }
}
