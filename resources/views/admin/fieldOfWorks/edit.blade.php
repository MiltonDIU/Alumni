@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.fieldOfWork.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.field-of-works.update", [$fieldOfWork->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.fieldOfWork.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $fieldOfWork->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.fieldOfWork.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="slug">{{ trans('cruds.fieldOfWork.fields.slug') }}</label>
                    <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $fieldOfWork->slug) }}" required>
                    @if($errors->has('slug'))
                        <div class="invalid-feedback">
                            {{ $errors->first('slug') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.fieldOfWork.fields.slug_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.fieldOfWork.fields.is_active') }}</label>
                    <select class="form-control {{ $errors->has('is_active') ? 'is-invalid' : '' }}" name="is_active" id="is_active" required>
                        <option value disabled {{ old('is_active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\FieldOfWork::IS_ACTIVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_active', $fieldOfWork->is_active) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_active'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_active') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.fieldOfWork.fields.is_active_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.fieldOfWork.fields.is_approve') }}</label>
                    <select class="form-control {{ $errors->has('is_approve') ? 'is-invalid' : '' }}" name="is_approve" id="is_approve">
                        <option value disabled {{ old('is_approve', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\FieldOfWork::IS_APPROVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_approve', $fieldOfWork->is_approve) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_approve'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_approve') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.fieldOfWork.fields.is_approve_helper') }}</span>
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
