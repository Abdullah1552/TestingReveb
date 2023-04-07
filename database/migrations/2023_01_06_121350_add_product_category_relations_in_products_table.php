<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddProductCategoryRelationsInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        $cat_id = DB::table('categories')->insertGetId([
            'name' => "general"
        ]);

        //products that categories does not exist
         DB::table('products')
            ->leftJoin('categories', 'products.product_category', '=', 'categories.id')
            ->whereNull('categories.name')
            ->update(['products.product_category'=>$cat_id] );

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('product_category')->references('id')
                ->on('categories')->onDelete('Restrict');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->unique('name');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['product_category']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique('name');
        });
    }
}
