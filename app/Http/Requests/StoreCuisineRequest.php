<?php

namespace App\Http\Requests;

use App\Models\Cuisine;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCuisineRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cuisine_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:cuisines',
            ],
        ];
    }
}
