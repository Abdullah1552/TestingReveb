<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhereHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('where_houses', function (Blueprint $table) {
            $table->id();
            $table->string('WH_Name');
            $table->string('WH_Mobile');
            $table->string('WH_Phone');
            $table->string('WH_Email');
            $table->string('WH_CYID');
            $table->string('WH_Address');
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
        Schema::dropIfExists('where_houses');
    }
}
