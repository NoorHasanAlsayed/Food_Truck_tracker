<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFoodTruckRequest;
use App\Http\Requests\StoreFoodTruckRequest;
use App\Http\Requests\UpdateFoodTruckRequest;
use App\Models\Cuisine;
use App\Models\Feature;
use App\Models\FoodTruck;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class FoodTruckController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('food_truck_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $foodTrucks = FoodTruck::with(['cuisines', 'features', 'user', 'media'])->get();

        $cuisines = Cuisine::get();

        $features = Feature::get();

        $users = User::get();

        return view('frontend.foodTrucks.index', compact('foodTrucks', 'cuisines', 'features', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('food_truck_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuisines = Cuisine::all()->pluck('name', 'id');

        $features = Feature::all()->pluck('name', 'id');

        return view('frontend.foodTrucks.create', compact('cuisines', 'features'));
    }

    public function store(StoreFoodTruckRequest $request)
    {

        $foodTruck = FoodTruck::create($request->all());
        $foodTruck->cuisines()->sync($request->input('cuisines', []));
        $foodTruck->features()->sync($request->input('features', []));
        foreach ($request->input('image', []) as $file) {
            $foodTruck->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $foodTruck->id]);
        }

        return redirect()->route('frontend.food-trucks.index');
    }

    public function edit(FoodTruck $foodTruck)
    {
        abort_if(Gate::denies('food_truck_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cuisines = Cuisine::all()->pluck('name', 'id');

        $features = Feature::all()->pluck('name', 'id');

        $foodTruck->load('cuisines', 'features', 'user');

        return view('frontend.foodTrucks.edit', compact('cuisines', 'features', 'foodTruck'));
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
        $media = $foodTruck->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $foodTruck->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }

        return redirect()->route('frontend.food-trucks.index');
    }

    public function show(FoodTruck $foodTruck)
    {
      //  abort_if(Gate::denies('food_truck_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $foodTruck->load('cuisines', 'features', 'user', 'truckReviews');

        $totalReviews= $foodTruck->truckReviews->count();
if($totalReviews>0){
        $avg= $foodTruck->truckReviews->avg('rate');

        $postive=$foodTruck->truckReviews->where('rate','>','3')->count() ;
        if( $postive )
        {
            $percent=($postive/$totalReviews) *100;
        }
    }
    else{
        $avg=0;
        $postive=0;
    }




        return view('frontend.foodTrucks.show', compact('foodTruck','totalReviews','avg','postive'));
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
