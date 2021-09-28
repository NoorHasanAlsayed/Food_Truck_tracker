<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTrucksTable extends Migration
{
    public function up()
    {
        Schema::create('food_trucks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('address')->nullable();
            $table->string('active')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
