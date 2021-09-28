<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureFoodTruckPivotTable extends Migration
{
    public function up()
    {
        Schema::create('feature_food_truck', function (Blueprint $table) {
            $table->unsignedBigInteger('food_truck_id');
            $table->foreign('food_truck_id', 'food_truck_id_fk_3748110')->references('id')->on('food_trucks')->onDelete('cascade');
            $table->unsignedBigInteger('feature_id');
            $table->foreign('feature_id', 'feature_id_fk_3748110')->references('id')->on('features')->onDelete('cascade');
        });
    }
}
