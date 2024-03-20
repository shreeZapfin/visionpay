<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->unsignedBigInteger('complaint_id')->index('complaint_messages_complaints_id_fk');
            $table->bigInteger('message_from_user_id')->index('complaint_messages_users_id_fk');
            $table->bigInteger('message_to_user_id')->index('complaint_messages_users_id_fk_2');
            $table->text('message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaint_messages');
    }
}
