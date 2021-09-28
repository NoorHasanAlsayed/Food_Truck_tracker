<?php

namespace App\Http\Requests;

use App\Models\FoodTruck;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFoodTruckRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('food_truck_create');
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
            'image.*' => [
                'required',
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
