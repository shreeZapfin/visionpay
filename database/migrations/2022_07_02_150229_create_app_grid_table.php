<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppGridTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_grid', function (Blueprint $table) {
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->integer('id', true);
            $table->string('label', 32)->nullable();
            $table->string('logo_url', 256)->nullable();
            $table->enum('type', ['singular', 'category'])->nullable();
            $table->string('redirect_to', 128)->nullable();
            $table->integer('unique_id')->nullable();
            $table->string('grid_for', 256)->nullable();
            $table->integer('grid_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_grid');
    }
}
