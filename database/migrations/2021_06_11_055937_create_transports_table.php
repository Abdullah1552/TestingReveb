<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->string('TR_Name');
            $table->string('TR_Mobile')->nullable();
            $table->string('TR_Phone')->nullable();
            $table->unsignedBigInteger('CYID');
            $table->string('TR_National_Tax')->nullable();
            $table->string('TR_Sale_Tax')->nullable();
            $table->unsignedBigInteger('AC_Type');
            $table->string('TR_Adress1');
            $table->string('TR_Adress2')->nullable();
            $table->unsignedBigInteger('BID')->nullable();
            $table->unsignedBigInteger('Created_By')->nullable();
            $table->unsignedBigInteger('Updated_By')->nullable();
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
        Schema::dropIfExists('transports');
    }
}
