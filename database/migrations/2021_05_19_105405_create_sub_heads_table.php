<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_heads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Sub_Head_Name');
            $table->unsignedBigInteger('HID');
            $table->unsignedBigInteger('RID');
            $table->unique(['Sub_Head_Name', 'HID', 'RID']);
            $table->timestamps();
            $table->foreign("HID")->references('id')->on('head_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_heads');
    }
}
