<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('head_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Head_Ac_Name');
            $table->unsignedBigInteger('RID');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("RID")->references('id')->on('root_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('head_accounts');
    }
}
