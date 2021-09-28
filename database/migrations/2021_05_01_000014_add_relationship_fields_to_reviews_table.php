<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3746965')->references('id')->on('users');
            $table->unsignedBigInteger('truck_id')->nullable();
            $table->foreign('truck_id', 'truck_fk_3746966')->references('id')->on('food_trucks');
        });
    }
}
