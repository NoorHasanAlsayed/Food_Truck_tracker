<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'assest_managment_access',
            ],
            [
                'id'    => 18,
                'title' => 'cuisine_create',
            ],
            [
                'id'    => 19,
                'title' => 'cuisine_edit',
            ],
            [
                'id'    => 20,
                'title' => 'cuisine_show',
            ],
            [
                'id'    => 21,
                'title' => 'cuisine_delete',
            ],
            [
                'id'    => 22,
                'title' => 'cuisine_access',
            ],
            [
                'id'    => 23,
                'title' => 'feature_create',
            ],
            [
                'id'    => 24,
                'title' => 'feature_edit',
            ],
            [
                'id'    => 25,
                'title' => 'feature_show',
            ],
            [
                'id'    => 26,
                'title' => 'feature_delete',
            ],
            [
                'id'    => 27,
                'title' => 'feature_access',
            ],
            [
                'id'    => 28,
                'title' => 'food_truck_create',
            ],
            [
                'id'    => 29,
                'title' => 'food_truck_edit',
            ],
            [
                'id'    => 30,
                'title' => 'food_truck_show',
            ],
            [
                'id'    => 31,
                'title' => 'food_truck_delete',
            ],
            [
                'id'    => 32,
                'title' => 'food_truck_access',
            ],
            [
                'id'    => 33,
                'title' => 'review_create',
            ],
            [
                'id'    => 34,
                'title' => 'review_edit',
            ],
            [
                'id'    => 35,
                'title' => 'review_show',
            ],
            [
                'id'    => 36,
                'title' => 'review_delete',
            ],
            [
                'id'    => 37,
                'title' => 'review_access',
            ],
            [
                'id'    => 38,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
