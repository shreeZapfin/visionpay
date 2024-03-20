<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->integer('id', true);
            $table->string('title')->nullable();
            $table->text('advertisement_img_url')->nullable();
            $table->text('body')->nullable();
            $table->integer('order');
            $table->tinyInteger('status')->nullable()->default(1);
            $table->enum('redirect_to', ['APP', 'WEB', 'NONE'])->nullable();
            $table->enum('redirect_app', ['PAYMENTS', 'DEPOSIT', 'BILLER'])->nullable();
            $table->enum('advertisement_type', ['IMAGE', 'TEXT'])->nullable();
            $table->text('redirect_web_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
