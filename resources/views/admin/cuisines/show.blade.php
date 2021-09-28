@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cuisine.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cuisines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cuisine.fields.id') }}
                        </th>
                        <td>
                            {{ $cuisine->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cuisine.fields.name') }}
                        </th>
                        <td>
                            {{ $cuisine->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cuisines.index') }}">
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
            <a class="nav-link" href="#cuisine_food_trucks" role="tab" data-toggle="tab">
                {{ trans('cruds.foodTruck.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="cuisine_food_trucks">
            @includeIf('admin.cuisines.relationships.cuisineFoodTrucks', ['foodTrucks' => $cuisine->cuisineFoodTrucks])
        </div>
    </div>
</div>

@endsection