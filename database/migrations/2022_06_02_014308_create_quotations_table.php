<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('WHID');
            $table->unsignedBigInteger('SUPID');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('saleperson_id');
            $table->decimal('order_tax');
            $table->decimal('shipping_cost');
            $table->decimal('discount');
            $table->decimal('net_total');
            $table->string('status');
            $table->string('note');
            $table->string('attach_document')->nullable();
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
        Schema::dropIfExists('quotations');
    }
}
