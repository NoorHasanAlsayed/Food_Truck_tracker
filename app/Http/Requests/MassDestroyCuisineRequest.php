<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Cuisine;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCuisineRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('cuisine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;

}
public function rules()
{




return [
'ids' => 'required|array',
    'ids.*' => 'exists:cuisines,id',
];

}

}
