<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToComplaintMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaint_messages', function (Blueprint $table) {
            $table->foreign('complaint_id', 'complaint_messages_complaints_id_fk')->references('id')->on('complaints')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('message_from_user_id', 'complaint_messages_users_id_fk')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('message_to_user_id', 'complaint_messages_users_id_fk_2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaint_messages', function (Blueprint $table) {
            $table->dropForeign('complaint_messages_complaints_id_fk');
            $table->dropForeign('complaint_messages_users_id_fk');
            $table->dropForeign('complaint_messages_users_id_fk_2');
        });
    }
}
