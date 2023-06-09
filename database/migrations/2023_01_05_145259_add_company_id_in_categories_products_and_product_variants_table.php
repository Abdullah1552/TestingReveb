<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdInCategoriesProductsAndProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->bigInteger('company_id');
            $table->foreign('company_id')->references('company_id')
                ->on('companies');
        });
        Schema::table('product_variants', function (Blueprint $table) {
            $table->bigInteger('company_id');
            $table->foreign('company_id')->references('company_id')
                ->on('companies');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->bigInteger('company_id');
            $table->foreign('company_id')->references('company_id')
                ->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('products', 'company_id'))
        {
            Schema::table('products', function (Blueprint $table)
            {
                $table->dropForeign(['company_id']);
                $table->dropColumn('company_id');
            });
        }
        if (Schema::hasColumn('product_variants', 'company_id'))
        {
            Schema::table('product_variants', function (Blueprint $table)
            {
                $table->dropForeign(['company_id']);
                $table->dropColumn('company_id');
            });
        }
        if (Schema::hasColumn('categories', 'company_id'))
        {
            Schema::table('categories', function (Blueprint $table)
            {
                $table->dropForeign(['company_id']);
                $table->dropColumn('company_id');
            });
        }
    }
}
