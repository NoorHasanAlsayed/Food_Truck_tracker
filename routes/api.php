<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Cuisines
    Route::apiResource('cuisines', 'CuisinesApiController');

    // Features
    Route::apiResource('features', 'FeaturesApiController');

    // Food Truck
    Route::post('food-trucks/media', 'FoodTruckApiController@storeMedia')->name('food-trucks.storeMedia');
    Route::apiResource('food-trucks', 'FoodTruckApiController');

    // Review
    Route::apiResource('reviews', 'ReviewApiController');
});
