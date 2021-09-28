@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.review.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.reviews.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="rate">{{ trans('cruds.review.fields.rate') }}</label>
                            <input class="form-control" type="text" name="rate" id="rate" value="{{ old('rate', '') }}" required>
                            @if($errors->has('rate'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rate') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.rate_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="body">{{ trans('cruds.review.fields.body') }}</label>
                            <input class="form-control" type="text" name="body" id="body" value="{{ old('body', '') }}">
                            @if($errors->has('body'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('body') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.body_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.review.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="truck_id">{{ trans('cruds.review.fields.truck') }}</label>
                            <select class="form-control select2" name="truck_id" id="truck_id">
                                @foreach($trucks as $id => $entry)
                                    <option value="{{ $id }}" {{ old('truck_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('truck'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('truck') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.review.fields.truck_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
