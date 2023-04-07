<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('SUPID');
            $table->boolean('lab')->default(0);
            $table->unsignedBigInteger('EMPID');
            $table->unsignedBigInteger('Payment_Term')->nullable();
            $table->string('Delivery_Via')->nullable();
            $table->unsignedBigInteger('Created_By')->nullable();
            $table->unsignedBigInteger('Updated_By')->nullable();
            $table->unsignedBigInteger('BID')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('Delivery_days')->default(0)->nullable();
            $table->date('Delivery_date')->nullable();
            $table->integer('Payment_on')->nullable();
            $table->date('After_delivery')->nullable();
            $table->string('Buyer_name')->nullable();
            $table->string('Contact_Person')->nullable();
            $table->text('Delivery_address')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
}
