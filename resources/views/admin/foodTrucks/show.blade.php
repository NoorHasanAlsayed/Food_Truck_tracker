@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.foodTruck.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.food-trucks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.foodTruck.fields.id') }}
                        </th>
                        <td>
                            {{ $foodTruck->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.foodTruck.fields.name') }}
                        </th>
                        <td>
                            {{ $foodTruck->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.foodTruck.fields.latitude') }}
                        </th>
                        <td>
                            {{ $foodTruck->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.foodTruck.fields.longitude') }}
                        </th>
                        <td>
                            {{ $foodTruck->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.foodTruck.fields.image') }}
                        </th>
                        <td>
                            @foreach($foodTruck->image as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.foodTruck.fields.address') }}
                        </th>
                        <td>
                            {{ $foodTruck->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.foodTruck.fields.active') }}
                        </th>
                        <td>
                            {{ App\Models\FoodTruck::ACTIVE_SELECT[$foodTruck->active] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.foodTruck.fields.cuisine') }}
                        </th>
                        <td>
                            @foreach($foodTruck->cuisines as $key => $cuisine)
                                <span class="label label-info">{{ $cuisine->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.foodTruck.fields.feature') }}
                        </th>
                        <td>
                            @foreach($foodTruck->features as $key => $feature)
                                <span class="label label-info">{{ $feature->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.foodTruck.fields.user') }}
                        </th>
                        <td>
                            {{ $foodTruck->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.food-trucks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#truck_reviews" role="tab" data-toggle="tab">
                {{ trans('cruds.review.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="truck_reviews">
            @includeIf('admin.foodTrucks.relationships.truckReviews', ['reviews' => $foodTruck->truckReviews])
        </div>
    </div>
</div>

@endsection