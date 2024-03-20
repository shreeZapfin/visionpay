<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('username', 128)->unique('users_username_uindex')->nullable();
            $table->string('mobile_no', 16)->unique('users_mobile_no_uindex')->nullable();
            $table->string('email', 128)->unique('users_email_uindex')->nullable();
            $table->string('password', 256);
            $table->string('first_name', 256)->nullable();
            $table->string('last_name', 256)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['MALE', 'FEMALE', 'TRANSGENDER'])->nullable();
            $table->text('address')->nullable();
            $table->string('transaction_pin', 256)->nullable();
            $table->text('selfie_img_url')->nullable();
            $table->text('profile_pic_img_url')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->text('kyc_document_url')->nullable();
            $table->enum('kyc_document_type', ['VOTERID', 'PASSPORT', 'DRIVING_LICENSE'])->nullable();
            $table->string('kyc_document_id', 256)->nullable();
            $table->date('kyc_document_expiry_date')->nullable();
            $table->bigInteger('city_id')->nullable()->index('users_cities_id_fk');
            $table->integer('user_type_id')->index('users_user_types_id_fk');
            $table->bigInteger('wallet_id')->unique('users_wallet_id_uindex');
            $table->string('pacpay_user_id', 128)->nullable();
            $table->tinyInteger('is_kyc_verified')->default(0);
            $table->bigInteger('kyc_verified_by')->nullable();
            $table->timestamp('kyc_verified_at')->nullable();
            $table->tinyInteger('is_registration_completed')->default(0);
            $table->integer('transfer_limit_scheme_id')->default(1);
            $table->integer('commission_scheme_id')->default(1);
            $table->tinyInteger('is_verified')->default(0);
            $table->string('payment_link', 1024)->nullable();
            $table->string('qr_code_info', 1024)->nullable();
            $table->boolean('account_blocked')->default(0);
            $table->bigInteger('user_permission_id');
            $table->tinyInteger('has_sub_accounts')->default(0);
            $table->bigInteger('master_account_user_id')->nullable();
            $table->string('personal_tin_no', 16)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
