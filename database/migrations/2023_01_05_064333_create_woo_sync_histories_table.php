<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWooSyncHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('woo_sync_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id');
            $table->json('categories_arr')->nullable();
            $table->json('products_arr')->nullable();
            $table->json('variants_arr')->nullable();
            $table->unsignedBigInteger('sync_by');
            $table->enum('is_completed',['0','1'])->default('0');
            $table->enum('sync_type',['upload_products','update_products','update_stock'])->default('upload_products');
            $table->longText('exception')->nullable();
            $table->longText('custom_error_message')->nullable();

            $table->foreign('sync_by')->references('id')
                ->on('users')->onDelete('cascade');

            $table->foreign('company_id')->references('company_id')
                ->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('woo_sync_histories');
    }
}
