<?php

Route::get('/','HomeController@homepage')->name('homepage');
Route::post('food-trucks/media', 'Frontend\FoodTruckController@storeMedia')->name('food-trucks.storeMedia');
Route::post('food-trucks/ckmedia', 'Frontend\FoodTruckController@storeCKEditorImages')->name('food-trucks.storeCKEditorImages');
Route::resource('food-trucks', 'Frontend\FoodTruckController');
Route::post('reviewStore', 'Frontend\ReviewController@store')->name('reviewStore');


Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Cuisines
    Route::delete('cuisines/destroy', 'CuisinesController@massDestroy')->name('cuisines.massDestroy');
    Route::resource('cuisines', 'CuisinesController');

    // Features
    Route::delete('features/destroy', 'FeaturesController@massDestroy')->name('features.massDestroy');
    Route::resource('features', 'FeaturesController');

    // Food Truck
    Route::delete('food-trucks/destroy', 'FoodTruckController@massDestroy')->name('food-trucks.massDestroy');
    Route::post('food-trucks/media', 'FoodTruckController@storeMedia')->name('food-trucks.storeMedia');
    Route::post('food-trucks/ckmedia', 'FoodTruckController@storeCKEditorImages')->name('food-trucks.storeCKEditorImages');
    Route::resource('food-trucks', 'FoodTruckController');

    // Review
    Route::delete('reviews/destroy', 'ReviewController@massDestroy')->name('reviews.massDestroy');
    Route::resource('reviews', 'ReviewController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Cuisines
    Route::delete('cuisines/destroy', 'CuisinesController@massDestroy')->name('cuisines.massDestroy');
    Route::resource('cuisines', 'CuisinesController');

    // Features
    Route::delete('features/destroy', 'FeaturesController@massDestroy')->name('features.massDestroy');
    Route::resource('features', 'FeaturesController');

    // Food Truck
    Route::delete('food-trucks/destroy', 'FoodTruckController@massDestroy')->name('food-trucks.massDestroy');
    // Route::post('food-trucks/media', 'FoodTruckController@storeMedia')->name('food-trucks.storeMedia');
    // Route::post('food-trucks/ckmedia', 'FoodTruckController@storeCKEditorImages')->name('food-trucks.storeCKEditorImages');
    // Route::resource('food-trucks', 'FoodTruckController');

    // Review
    Route::delete('reviews/destroy', 'ReviewController@massDestroy')->name('reviews.massDestroy');
    Route::resource('reviews', 'ReviewController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
