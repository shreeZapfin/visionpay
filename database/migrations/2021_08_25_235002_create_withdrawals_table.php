<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->integer('id', true);
            $table->string('withdrawal_id', 32);
            $table->decimal('amount', 10);
            $table->enum('status',['INITIATED_BY_AGENT','EXPIRED','ACCEPTED_BY_USER','DECLINED_BY_USER','BANK_WITHDRAWAL_REQUEST','BANK_WITHDRAWAL_PAID','BANK_WITHDRAWAL_FAILED','ADMIN_WITHDRAWAL']);
            $table->bigInteger('user_id')->index('withdrawal_users_id_fk');
            $table->integer('agent_id')->index('withdrawal_agents_id_fk')->nullable();
            $table->boolean('is_bank_withdrawal')->default(false);
            $table->json('bank_details')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->text('remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
}
