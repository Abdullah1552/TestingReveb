<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('Item_Name');
            $table->string('Item_Article')->nullable();
            $table->unsignedBigInteger('BRID')->nullable();
            $table->string('Item_Origin')->nullable();
            $table->string('Item_Tech')->nullable();
            $table->string('Item_Pack_Size')->nullable();
            $table->unsignedBigInteger('Item_UOM')->nullable();
            $table->bigInteger('Item_Min_Qty')->nullable();
            $table->bigInteger('Item_Max_Qty')->nullable();
            $table->bigInteger('Item_Hold_Qty')->nullable();
            $table->bigInteger('Item_Booked_Qty')->nullable();
            $table->unsignedBigInteger('Item_Type')->nullable();
            $table->boolean('Item_Inventory')->nullable();
            $table->unsignedBigInteger('Item_Valuation_Method')->nullable();
            $table->decimal('Dealer_Margin')->nullable();
            $table->decimal('Item_sale_Unit',50,2)->nullable();
            $table->decimal('Item_sale_Fraction',50,2)->nullable();
            $table->decimal('Item_Purchase_Unit',50,2)->nullable();
            $table->decimal('Item_Purchase_Fraction',50,2)->nullable();
            $table->decimal('Item_Price_Ex_Gst',50,2)->nullable();
            $table->decimal('Item_STax_Per',50,2)->nullable();
            $table->decimal('Item_Price_Inc_Gst',50,2)->nullable();
            $table->decimal('Item_Total_Rec',50,2)->nullable();
            $table->decimal('Item_Total_Issued',50,2)->nullable();
            $table->decimal('Item_Balance',50,2)->nullable();
            $table->unsignedBigInteger('GL_Sale')->nullable();
            $table->unsignedBigInteger('GL_Purchase')->nullable();
            $table->unsignedBigInteger('GL_Discount')->nullable();
            $table->unsignedBigInteger('GL_STax')->nullable();
            $table->unsignedBigInteger('BID')->nullable();
            $table->unsignedBigInteger('Created_BY')->nullable();
            $table->unsignedBigInteger('Updated_By')->nullable();
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
        Schema::dropIfExists('items');
    }
}
