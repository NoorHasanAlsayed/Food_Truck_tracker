<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFoodTruckRequest;
use App\Http\Requests\StoreFoodTruckRequest;
use App\Http\Requests\UpdateFoodTruckRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Cuisine;
use App\Models\Feature;
use App\Models\FoodTruck;
use App\Models\User;
use App\Models\Day;

use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FoodTruckController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        // abort_if(Gate::denies('food_truck_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $foodTrucks = FoodTruck::with(['cuisines', 'features', 'user', 'media'])->get();

        $cuisines = Cuisine::get();

        $features = Feature::get();

        $users = User::get();

        return view('admin.foodTrucks.index', compact('foodTrucks', 'cuisines', 'features', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('food_truck_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuisines = Cuisine::all()->pluck('name', 'id');

        $features = Feature::all()->pluck('name', 'id');
        $days = Day::all();

        return view('admin.foodTrucks.create', compact('cuisines', 'features','days'));
    }

    public function store(StoreFoodTruckRequest $request)
    {
        $foodTruck = FoodTruck::create($request->all());
        $owner= User::find(Auth::user()->id);
        $owner->food_truck_id=$foodTruck->id;
        $owner->roles()->sync([
    'role_id'=>2
            ]);

        $owner->save();
        $foodTruck->cuisines()->sync($request->input('cuisines', []));
        $foodTruck->features()->sync($request->input('features', []));
        foreach ($request->input('image', []) as $file) {
            $foodTruck->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $foodTruck->id]);
        }
        $hours = collect($request->input('from_hours'))->mapWithKeys(function($value, $id) use ($request) {
            return $value ? [
                    $id => [
                        'from_hours'    => $value,
                        'from_minutes'  => $request->input('from_minutes.'.$id),
                        'to_hours'      => $request->input('to_hours.'.$id),
                        'to_minutes'    => $request->input('to_minutes.'.$id)
                    ]
                ]
                : [];
        });
        $foodTruck->days()->sync($hours);

        return redirect()->route('admin.food-trucks.index');
    }

    public function edit(FoodTruck $foodTruck)
    {
        abort_if(Gate::denies('food_truck_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuisines = Cuisine::all()->pluck('name', 'id');

        $features = Feature::all()->pluck('name', 'id');

        $foodTruck->load('cuisines', 'features', 'user');
        $days = Day::all();

        return view('admin.foodTrucks.edit', compact('cuisines', 'features', 'foodTruck', 'days'));
    }

    public function update(UpdateFoodTruckRequest $request, FoodTruck $foodTruck)
    {
        $foodTruck->update($request->all());
        $foodTruck->cuisines()->sync($request->input('cuisines', []));
        $foodTruck->features()->sync($request->input('features', []));
        if (count($foodTruck->image) > 0) {
            foreach ($foodTruck->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }
        $hours = collect($request->input('from_hours'))->mapWithKeys(function($value, $id) use ($request) {
            return $value ? [
                    $id => [
                        'from_hours'    => $value,
                        'from_minutes'  => $request->input('from_minutes.'.$id),
                        'to_hours'      => $request->input('to_hours.'.$id),
                        'to_minutes'    => $request->input('to_minutes.'.$id)
                    ]
                ]
                : [];
        });
        $foodTruck->days()->sync($hours);
        $media = $foodTruck->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $foodTruck->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.food-trucks.index');
    }

    public function show(FoodTruck $foodTruck)
    {
        abort_if(Gate::denies('food_truck_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $foodTruck->load('cuisines', 'features', 'user', 'truckReviews');

        return view('admin.foodTrucks.show', compact('foodTruck'));
    }

    public function destroy(FoodTruck $foodTruck)
    {
        abort_if(Gate::denies('food_truck_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $foodTruck->delete();

        return back();
    }

    public function massDestroy(MassDestroyFoodTruckRequest $request)
    {
        FoodTruck::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('food_truck_create') && Gate::denies('food_truck_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new FoodTruck();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
