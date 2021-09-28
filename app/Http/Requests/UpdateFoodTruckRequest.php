<?php

namespace App\Http\Requests;

use App\Models\FoodTruck;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFoodTruckRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('food_truck_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'latitude' => [
                'string',
                'nullable',
            ],
            'longitude' => [
                'string',
                'nullable',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'cuisines.*' => [
                'integer',
            ],
            'cuisines' => [
                'required',
                'array',
            ],
            'features.*' => [
                'integer',
            ],
            'features' => [
                'array',
            ],
        ];
    }
}
