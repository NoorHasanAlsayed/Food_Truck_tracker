@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.foodTruck.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.food-trucks.update", [$foodTruck->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.foodTruck.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $foodTruck->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.foodTruck.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.foodTruck.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', $foodTruck->latitude) }}"  onfocus="getLocation()" readonly>
                @if($errors->has('latitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('latitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.foodTruck.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.foodTruck.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', $foodTruck->longitude) }}"readonly>
                @if($errors->has('longitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('longitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.foodTruck.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="image">{{ trans('cruds.foodTruck.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.foodTruck.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.foodTruck.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $foodTruck->address) }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.foodTruck.fields.address_helper') }}</span>
            </div>
            @if(Auth::user()->id == 1)
            <div class="form-group">
                <label>{{ trans('cruds.foodTruck.fields.active') }}</label>
                <select class="form-control {{ $errors->has('active') ? 'is-invalid' : '' }}" name="active" id="active">
                    <option value disabled {{ old('active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\FoodTruck::ACTIVE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('active', $foodTruck->active) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.foodTruck.fields.active_helper') }}</span>
            </div>
            @endif
            <div class="form-group">
                <label class="required" for="cuisines">{{ trans('cruds.foodTruck.fields.cuisine') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('cuisines') ? 'is-invalid' : '' }}" name="cuisines[]" id="cuisines" multiple required>
                    @foreach($cuisines as $id => $cuisine)
                        <option value="{{ $id }}" {{ (in_array($id, old('cuisines', [])) || $foodTruck->cuisines->contains($id)) ? 'selected' : '' }}>{{ $cuisine }}</option>
                    @endforeach
                </select>
                @if($errors->has('cuisines'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cuisines') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.foodTruck.fields.cuisine_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="features">{{ trans('cruds.foodTruck.fields.feature') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('features') ? 'is-invalid' : '' }}" name="features[]" id="features" multiple>
                    @foreach($features as $id => $feature)
                        <option value="{{ $id }}" {{ (in_array($id, old('features', [])) || $foodTruck->features->contains($id)) ? 'selected' : '' }}>{{ $feature }}</option>
                    @endforeach
                </select>
                @if($errors->has('features'))
                    <div class="invalid-feedback">
                        {{ $errors->first('features') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.foodTruck.fields.feature_helper') }}</span>
            </div>
            <label>{{ trans('cruds.foodTruck.working_hours') }}</label>
            @foreach($days as $day)
                <div class="form-inline">
                    <label class="my-1 mr-2">{{ ucfirst($day->name) }}: from</label>
                    <select class="custom-select my-1 mr-sm-2" name="from_hours[{{ $day->id }}]">
                        <option value="">--</option>
                        @foreach(range(0,23) as $hours)
                            <option
                                value="{{ $hours < 10 ? "0$hours" : $hours }}"
                                {{ old('from_hours.'.$day->id, $foodTruck->days->find($day->id) ? $foodTruck->days->find($day->id)->pivot['from_hours'] : null) == ($hours < 10 ? "0$hours" : $hours) ? 'selected' : '' }}
                            >{{ $hours < 10 ? "0$hours" : $hours }}</option>
                        @endforeach
                    </select>
                    <label class="my-1 mr-2">:</label>
                    <select class="custom-select my-1 mr-sm-2" name="from_minutes[{{ $day->id }}]">
                        <option value="">--</option>
                        <option value="00" {{ old('from_minutes.'.$day->id, $foodTruckp->days->find($day->id) ? $foodTruck->days->find($day->id)->pivot['from_minutes'] : null) == '00' ? 'selected' : '' }}>00</option>
                        <option value="30" {{ old('from_minutes.'.$day->id, $foodTruck->days->find($day->id) ? $foodTruck->days->find($day->id)->pivot['from_minutes'] : null) == '30' ? 'selected' : '' }}>30</option>
                    </select>
                    <label class="my-1 mr-2">to</label>
                    <select class="custom-select my-1 mr-sm-2" name="to_hours[{{ $day->id }}]">
                        <option value="">--</option>
                        @foreach(range(0,23) as $hours)
                            <option
                                value="{{ $hours < 10 ? "0$hours" : $hours }}"
                                {{ old('to_hours.'.$day->id, $foodTruck->days->find($foodTruck->id) ? $foodTruck->days->find($day->id)->pivot['to_hours'] : null) == ($hours < 10 ? "0$hours" : $hours) ? 'selected' : '' }}
                            >{{ $hours < 10 ? "0$hours" : $hours }}</option>
                        @endforeach
                    </select>
                    <label class="my-1 mr-2">:</label>
                    <select class="custom-select my-1 mr-sm-2" name="to_minutes[{{ $day->id }}]">
                        <option value="">--</option>
                        <option value="00" {{ old('to_minutes.'.$day->id, $foodTruck->days->find($day->id) ? $foodTruck->days->find($day->id)->pivot['to_minutes'] : null) == '00' ? 'selected' : '' }}>00</option>
                        <option value="30" {{ old('to_minutes.'.$day->id, $foodTruck->days->find($day->id) ? $foodTruck->days->find($day->id)->pivot['to_minutes'] : null) == '30' ? 'selected' : '' }}>30</option>
                    </select>
                </div>
            @endforeach
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}


function showPosition(position) {
  document.getElementById("longitude").value = position.coords.longitude;
  document.getElementById("latitude").value = position.coords.latitude;

}
    var uploadedImageMap = {}
Dropzone.options.imageDropzone = {
    url: '{{ route('admin.food-trucks.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
      uploadedImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImageMap[file.name]
      }
      $('form').find('input[name="image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($foodTruck) && $foodTruck->image)
      var files = {!! json_encode($foodTruck->image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="image[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection
