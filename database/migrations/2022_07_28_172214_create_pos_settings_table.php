<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('default_customer');
            $table->unsignedBigInteger('default_location');
            $table->unsignedBigInteger('default_saleperson');
            $table->text('invoice_header');
            $table->text('invoice_footer');
            $table->unsignedBigInteger('thermal_format');
            $table->unsignedBigInteger('a_format');
            $table->text('inv_loog');
            $table->text('qr_img')->nullable();
            $table->boolean('purchase_tax')->default(0)->nullable();
            $table->decimal('purchase_tax_val')->default(0)->nullable();
            $table->boolean('sale_tax')->default(0)->nullable();
            $table->decimal('sale_tax_val')->default(0)->nullable();
            $table->boolean('wat')->default(0)->nullable();
            $table->decimal('wat_val')->default(0)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('pos_settings');
    }
}
