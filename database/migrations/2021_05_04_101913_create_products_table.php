<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('w_id');
			$table->string('name');
			$table->unsignedBigInteger('brand_id');
			$table->string('product_code');
			$table->unsignedBigInteger('product_category');
			$table->decimal('weight');
			$table->unsignedBigInteger('unit');
			$table->decimal('product_cost',20,2)->nullable();
			$table->decimal('product_price',20,2)->nullable();
			$table->boolean('inventory')->default();
			$table->bigInteger('alert_qty')->nullable();
			$table->bigInteger('product_tax')->default(0);
			$table->unsignedBigInteger('tax_method')->default(0);
			$table->boolean('featured')->default(0);
			$table->text('product_images');
            $table->text('detail');
            $table->decimal('promotional_price',20,2)->nullable();
            $table->boolean('is_diffPrice')->default(0);
            $table->boolean('is_variant')->default(0);
            $table->boolean('is_promo')->default(0);
            $table->date('promotional_start')->nullable();
            $table->date('promotional_end')->nullable();
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
        Schema::dropIfExists('products');
    }
}
