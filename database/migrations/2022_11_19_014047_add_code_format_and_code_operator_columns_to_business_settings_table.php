<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodeFormatAndCodeOperatorColumnsToBusinessSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_settings', function (Blueprint $table) {
            $table->enum('code_format',array('C', 'YC', 'MYC', 'YMC'))->default('C');
            $table->string('code_separator')->default('-');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_settings', function (Blueprint $table)
        {
            if (Schema::hasColumn('business_settings', 'code_format'))
                $table->dropColumn('code_format');
            if (Schema::hasColumn('business_settings', 'code_separator'))
                $table->dropColumn('code_separator');
        });
    }
}
