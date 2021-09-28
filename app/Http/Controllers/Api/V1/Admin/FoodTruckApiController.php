<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFoodTruckRequest;
use App\Http\Requests\UpdateFoodTruckRequest;
use App\Http\Resources\Admin\FoodTruckResource;
use App\Models\FoodTruck;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FoodTruckApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('food_truck_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FoodTruckResource(FoodTruck::with(['cuisines', 'features', 'user'])->get());
    }

    public function store(StoreFoodTruckRequest $request)
    {
        $foodTruck = FoodTruck::create($request->all());
        $foodTruck->cuisines()->sync($request->input('cuisines', []));
        $foodTruck->features()->sync($request->input('features', []));
        if ($request->input('image', false)) {
            $foodTruck->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new FoodTruckResource($foodTruck))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FoodTruck $foodTruck)
    {
        abort_if(Gate::denies('food_truck_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FoodTruckResource($foodTruck->load(['cuisines', 'features', 'user']));
    }

    public function update(UpdateFoodTruckRequest $request, FoodTruck $foodTruck)
    {
        $foodTruck->update($request->all());
        $foodTruck->cuisines()->sync($request->input('cuisines', []));
        $foodTruck->features()->sync($request->input('features', []));
        if ($request->input('image', false)) {
            if (!$foodTruck->image || $request->input('image') !== $foodTruck->image->file_name) {
                if ($foodTruck->image) {
                    $foodTruck->image->delete();
                }
                $foodTruck->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($foodTruck->image) {
            $foodTruck->image->delete();
        }

        return (new FoodTruckResource($foodTruck))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FoodTruck $foodTruck)
    {
        abort_if(Gate::denies('food_truck_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $foodTruck->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
