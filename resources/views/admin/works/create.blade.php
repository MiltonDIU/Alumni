@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.work.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.works.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="field_of_work_id">{{ trans('cruds.work.fields.field_of_work') }}</label>
                    <select class="form-control select2 {{ $errors->has('field_of_work') ? 'is-invalid' : '' }}" name="field_of_work_id" id="field_of_work_id" required>
                        @foreach($field_of_works as $id => $entry)
                            <option value="{{ $id }}" {{ old('field_of_work_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('field_of_work'))
                        <div class="invalid-feedback">
                            {{ $errors->first('field_of_work') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.work.fields.field_of_work_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="organization_id">{{ trans('cruds.work.fields.organization') }}</label>
                    <select class="form-control select2 {{ $errors->has('organization') ? 'is-invalid' : '' }}" name="organization_id" id="organization_id" required>
                        @foreach($organizations as $id => $entry)
                            <option value="{{ $id }}" {{ old('organization_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('organization'))
                        <div class="invalid-feedback">
                            {{ $errors->first('organization') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.work.fields.organization_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="designation_id">{{ trans('cruds.work.fields.designation') }}</label>
                    <select class="form-control select2 {{ $errors->has('designation') ? 'is-invalid' : '' }}" name="designation_id" id="designation_id" required>
                        @foreach($designations as $id => $entry)
                            <option value="{{ $id }}" {{ old('designation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('designation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('designation') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.work.fields.designation_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="joining_date">{{ trans('cruds.work.fields.joining_date') }}</label>
                    <input class="form-control date {{ $errors->has('joining_date') ? 'is-invalid' : '' }}" type="text" name="joining_date" id="joining_date" value="{{ old('joining_date') }}" required>
                    @if($errors->has('joining_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('joining_date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.work.fields.joining_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="resign_date">{{ trans('cruds.work.fields.resign_date') }}</label>
                    <input class="form-control date {{ $errors->has('resign_date') ? 'is-invalid' : '' }}" type="text" name="resign_date" id="resign_date" value="{{ old('resign_date') }}">
                    @if($errors->has('resign_date'))
                        <div class="invalid-feedback">
                            {{ $errors->first('resign_date') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.work.fields.resign_date_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.work.fields.is_current_job') }}</label>
                    <select class="form-control {{ $errors->has('is_current_job') ? 'is-invalid' : '' }}" name="is_current_job" id="is_current_job" required>
                        <option value disabled {{ old('is_current_job', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Work::IS_CURRENT_JOB_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_current_job', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_current_job'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_current_job') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.work.fields.is_current_job_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.work.fields.view_on_publicly') }}</label>
                    <select class="form-control {{ $errors->has('view_on_publicly') ? 'is-invalid' : '' }}" name="view_on_publicly" id="view_on_publicly" required>
                        <option value disabled {{ old('view_on_publicly', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Work::VIEW_ON_PUBLICLY_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('view_on_publicly', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('view_on_publicly'))
                        <div class="invalid-feedback">
                            {{ $errors->first('view_on_publicly') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.work.fields.view_on_publicly_helper') }}</span>
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
