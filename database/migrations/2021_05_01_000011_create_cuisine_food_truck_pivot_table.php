<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuisineFoodTruckPivotTable extends Migration
{
    public function up()
    {
        Schema::create('cuisine_food_truck', function (Blueprint $table) {
            $table->unsignedBigInteger('food_truck_id');
            $table->foreign('food_truck_id', 'food_truck_id_fk_3748109')->references('id')->on('food_trucks')->onDelete('cascade');
            $table->unsignedBigInteger('cuisine_id');
            $table->foreign('cuisine_id', 'cuisine_id_fk_3748109')->references('id')->on('cuisines')->onDelete('cascade');
        });
    }
}
