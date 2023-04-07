<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterNetTotalInTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transfers', function (Blueprint $table) {
            DB::statement("ALTER TABLE `transfers` CHANGE `net_total` `net_total` DECIMAL(20,2) NULL DEFAULT NULL;");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transfers', function (Blueprint $table) {
            DB::statement("ALTER TABLE `transfers` CHANGE `net_total` `net_total` DECIMAL(20,2) NOT  NULL;");
        });
    }
}
