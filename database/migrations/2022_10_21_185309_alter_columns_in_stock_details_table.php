<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterColumnsInStockDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_details', function (Blueprint $table) {
           DB::statement("ALTER TABLE `stock_details` CHANGE `PID` `PID` BIGINT UNSIGNED NULL DEFAULT '0';");
           DB::statement("ALTER TABLE `stock_details` CHANGE `SID` `SID` BIGINT UNSIGNED NULL DEFAULT '0';");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_details', function (Blueprint $table) {
            DB::statement("ALTER TABLE `stock_details` CHANGE `PID` `PID` BIGINT UNSIGNED NULL DEFAULT NULL;");
            DB::statement("ALTER TABLE `stock_details` CHANGE `SID` `SID` BIGINT UNSIGNED NULL DEFAULT NULL;");
        });
    }
}
