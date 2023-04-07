<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('trans_id');
            $table->string('company_name');
            $table->unsignedBigInteger('customer_group_id');
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->string('address')->nullable();
            $table->string('tax_number')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->string('country_id');
            $table->string('postal_code');
            $table->string('state');
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
        Schema::dropIfExists('customers');
    }
}
