<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayFoodTrruckPovitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_food_truck', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('day_id');
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
            $table->foreignId('food_truck_id');
            $table->foreign('food_truck_id')->references('id')->on('food_trucks')->onDelete('cascade');
            $table->string('from_hours');
            $table->string('from_minutes');
            $table->string('to_hours');
            $table->string('to_minutes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('=day_food_truck');
    }
}
