<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_date');
            $table->unsignedBigInteger('SUPID');
            $table->unsignedBigInteger('WHID');
            $table->bigInteger('trans_code')->unique();
            $table->unsignedBigInteger('purchase_status');
            $table->text('attached_document');
            $table->bigInteger('order_tax')->nullable();
            $table->decimal('shipping_cost',20,2)->nullable();
            $table->decimal('discount',20,2)->nullable();
            $table->decimal('net_total',20,2)->nullable();
            $table->text('inovice_details')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('SUPID')->references('id')
                ->on('suppliers')->onDelete('restrict');
            $table->foreign('WHID')->references('id')
                ->on('where_houses')->onDelete('restrict');
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
        Schema::dropIfExists('purchase_invoices');
    }
}
