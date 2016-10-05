<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refuels', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price');
            $table->float('distance');
            $table->float('fuel_amount');
            $table->integer('user_vehicle_id')->unsigned()->index();
            $table->integer('petrol_station_id')->unsigned()->index();
            $table->integer('fuel_type_id')->unsigned()->index();
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
        Schema::drop('refuels');
    }
}
