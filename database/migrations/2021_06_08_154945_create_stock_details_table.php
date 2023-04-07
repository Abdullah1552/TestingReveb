<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('product_code');
            $table->string('batch_no');
            $table->unsignedBigInteger('Unit');
            $table->bigInteger('Qty');
            $table->decimal('Unit_cost',50,2);
            $table->decimal('discount',50,2)->nullable();
            $table->decimal('tax',50,2)->nullable();
            $table->decimal('sub_total',50,2);
            $table->unsignedBigInteger('PID')->nullable();
            $table->unsignedBigInteger('SID')->nullable();
            $table->unsignedBigInteger('WHID')->nullable();
            $table->boolean('in_out');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_details');
    }
}
