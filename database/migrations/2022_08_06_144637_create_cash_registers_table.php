<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_registers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('WHID');
            $table->decimal('cash_in_hand')->default(0);
            $table->decimal('total_sale')->default(0);
            $table->decimal('total_cash')->default(0);
            $table->decimal('cash_payment')->default(0);
            $table->decimal('credit_card_payment')->default(0);
            $table->decimal('qr_code_payment')->default(0);
            $table->decimal('other_payment')->default(0);
            $table->decimal('total_sale_return')->default(0);
            $table->decimal('total_expense')->default(0);
            $table->boolean('status')->default(0)->comment('0 mean open 1 mean closed');
            $table->unsignedBigInteger('open_by')->default(0)->nullable();
            $table->unsignedBigInteger('closed_by')->default(0)->nullable();
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
        Schema::dropIfExists('cash_registers');
    }
}
