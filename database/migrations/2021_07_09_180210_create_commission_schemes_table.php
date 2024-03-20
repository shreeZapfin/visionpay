<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionSchemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_schemes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 64);
            $table->enum('commission_type', ['PERCENTAGE', 'PER_TXN'])->nullable()->default('PER_TXN');
            $table->decimal('commission_value', 10)->nullable()->default(0.00);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commission_schemes');
    }
}
