<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatePassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_passes', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('SUPID');
            $table->unsignedBigInteger('POID');
            $table->string('Driver_name');
            $table->string('Driver_cnic')->nullable();
            $table->string('Vehicle_number')->nullable();
            $table->unsignedBigInteger('Vehicle_type')->nullable();
            $table->bigInteger('No_bags')->nullable();
            $table->decimal('F_weight',50,2)->nullable();
            $table->decimal('S_weight',50,2)->nullable();
            $table->decimal('Net_weight',50,2)->nullable();
            $table->text('Delivery_address')->nullable();
            $table->unsignedBigInteger('BID')->nullable();
            $table->decimal('Weighing_charges',50,2)->nullable();
            $table->decimal('Trans_charges',50,2)->nullable();
            $table->string('Raw_material_nature')->nullable();
            $table->time('Time_in')->nullable();
            $table->time('Time_out')->nullable();
            $table->time('Unloading_time')->nullable();
            $table->unsignedBigInteger('Unloading_type')->nullable();
            $table->unsignedBigInteger('WHID')->nullable();
            $table->string('Bilty_No')->nullable();
            $table->string('DC_No')->nullable();
            $table->string('Fanacial_email')->nullable();
            $table->string('Owner_email')->nullable();
            $table->unsignedBigInteger('Created_by')->nullable();
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
        Schema::dropIfExists('gate_passes');
    }
}
