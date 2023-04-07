<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterColumnsInWoocommerceSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


       Schema::table('woocommerce_settings', function (Blueprint $table) {
            DB::statement('ALTER TABLE `woocommerce_settings` CHANGE `woocommerce_url` `woocommerce_url` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;');
            DB::statement('ALTER TABLE `woocommerce_settings` CHANGE `woocommerce_sk` `woocommerce_sk` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;');
            DB::statement('ALTER TABLE `woocommerce_settings` CHANGE `woocommerce_sc` `woocommerce_sc` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('woocommerce_settings', function (Blueprint $table) {
            DB::statement('ALTER TABLE `woocommerce_settings` CHANGE `woocommerce_url` `woocommerce_url` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;');
            DB::statement('ALTER TABLE `woocommerce_settings` CHANGE `woocommerce_sk` `woocommerce_sk` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;');
            DB::statement('ALTER TABLE `woocommerce_settings` CHANGE `woocommerce_sc` `woocommerce_sc` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;');
        });
    }
}
