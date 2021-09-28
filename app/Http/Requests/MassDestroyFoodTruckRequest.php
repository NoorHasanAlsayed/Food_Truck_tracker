<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\FoodTruck;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFoodTruckRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('food_truck_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;
    
}
public function rules()
{
    



return [
'ids' => 'required|array',
    'ids.*' => 'exists:food_trucks,id',
]
    
}

}