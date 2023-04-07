<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_invoices', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('sale_person')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('WHID');
            $table->decimal('order_tax');
            $table->decimal('shipping_cost');
            $table->decimal('discount');
            $table->decimal('net_total');
            $table->string('payment_status');
            $table->string('attach_document');
            $table->string('sale_status');
            $table->string('sale_note');
            $table->string('staff_note');
            $table->string('reference_number');

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
        Schema::dropIfExists('sale_invoices');
    }
}
