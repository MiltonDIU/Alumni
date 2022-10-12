@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.upazila.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.upazilas.update", [$upazila->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="district_id">{{ trans('cruds.upazila.fields.district') }}</label>
                    <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id" required>
                        @foreach($districts as $id => $entry)
                            <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $upazila->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('district'))
                        <div class="invalid-feedback">
                            {{ $errors->first('district') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.upazila.fields.district_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.upazila.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $upazila->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.upazila.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="slug">{{ trans('cruds.upazila.fields.slug') }}</label>
                    <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $upazila->slug) }}" required>
                    @if($errors->has('slug'))
                        <div class="invalid-feedback">
                            {{ $errors->first('slug') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.upazila.fields.slug_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="bn_name">{{ trans('cruds.upazila.fields.bn_name') }}</label>
                    <input class="form-control {{ $errors->has('bn_name') ? 'is-invalid' : '' }}" type="text" name="bn_name" id="bn_name" value="{{ old('bn_name', $upazila->bn_name) }}">
                    @if($errors->has('bn_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('bn_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.upazila.fields.bn_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="url">{{ trans('cruds.upazila.fields.url') }}</label>
                    <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $upazila->url) }}">
                    @if($errors->has('url'))
                        <div class="invalid-feedback">
                            {{ $errors->first('url') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.upazila.fields.url_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.upazila.fields.is_active') }}</label>
                    <select class="form-control {{ $errors->has('is_active') ? 'is-invalid' : '' }}" name="is_active" id="is_active">
                        <option value disabled {{ old('is_active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Upazila::IS_ACTIVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_active', $upazila->is_active) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_active'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_active') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.upazila.fields.is_active_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection
