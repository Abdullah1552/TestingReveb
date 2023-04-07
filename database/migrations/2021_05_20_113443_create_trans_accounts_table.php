<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Trans_Acc_Name');
            $table->unsignedBigInteger('PID');
            $table->unsignedBigInteger('Parent_Type')->nullable();
            $table->string('OB')->nullable();
            $table->smallInteger('OB_Type')->nullable();
            $table->unsignedBigInteger('BID')->default(1);
            $table->unsignedBigInteger('Created_BY')->nullable();
            $table->unsignedBigInteger('Updated_By')->nullable();
            $table->time('Last_Activity')->nullable();
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
        Schema::dropIfExists('trans_accounts');
    }
}
