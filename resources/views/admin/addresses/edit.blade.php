@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.address.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.addresses.update", [$address->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="division_id">{{ trans('cruds.address.fields.division') }}</label>
                    <select class="form-control select2 {{ $errors->has('division') ? 'is-invalid' : '' }}" name="division_id" id="division_id">
                        @foreach($divisions as $id => $entry)
                            <option value="{{ $id }}" {{ (old('division_id') ? old('division_id') : $address->division->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('division'))
                        <div class="invalid-feedback">
                            {{ $errors->first('division') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.division_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="district_id">{{ trans('cruds.address.fields.district') }}</label>
                    <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id">
                        @foreach($districts as $id => $entry)
                            <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $address->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('district'))
                        <div class="invalid-feedback">
                            {{ $errors->first('district') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.district_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="upazila_id">{{ trans('cruds.address.fields.upazila') }}</label>
                    <select class="form-control select2 {{ $errors->has('upazila') ? 'is-invalid' : '' }}" name="upazila_id" id="upazila_id">
                        @foreach($upazilas as $id => $entry)
                            <option value="{{ $id }}" {{ (old('upazila_id') ? old('upazila_id') : $address->upazila->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('upazila'))
                        <div class="invalid-feedback">
                            {{ $errors->first('upazila') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.upazila_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="union_id">{{ trans('cruds.address.fields.union') }}</label>
                    <select class="form-control select2 {{ $errors->has('union') ? 'is-invalid' : '' }}" name="union_id" id="union_id">
                        @foreach($unions as $id => $entry)
                            <option value="{{ $id }}" {{ (old('union_id') ? old('union_id') : $address->union->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('union'))
                        <div class="invalid-feedback">
                            {{ $errors->first('union') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.union_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="area">{{ trans('cruds.address.fields.area') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('area') ? 'is-invalid' : '' }}" name="area" id="area">{!! old('area', $address->area) !!}</textarea>
                    @if($errors->has('area'))
                        <div class="invalid-feedback">
                            {{ $errors->first('area') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.area_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.address.fields.type_of_address') }}</label>
                    <select class="form-control {{ $errors->has('type_of_address') ? 'is-invalid' : '' }}" name="type_of_address" id="type_of_address" required>
                        <option value disabled {{ old('type_of_address', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Address::TYPE_OF_ADDRESS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('type_of_address', $address->type_of_address) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('type_of_address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('type_of_address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.type_of_address_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.address.fields.view_on_publicly') }}</label>
                    <select class="form-control {{ $errors->has('view_on_publicly') ? 'is-invalid' : '' }}" name="view_on_publicly" id="view_on_publicly" required>
                        <option value disabled {{ old('view_on_publicly', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Address::VIEW_ON_PUBLICLY_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('view_on_publicly', $address->view_on_publicly) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('view_on_publicly'))
                        <div class="invalid-feedback">
                            {{ $errors->first('view_on_publicly') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.address.fields.view_on_publicly_helper') }}</span>
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

@section('scripts')
    <script>
        $(document).ready(function () {
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function (file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', '{{ route('admin.addresses.storeCKEditorImages') }}', true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() { reject(genericErrorText) });
                                        xhr.addEventListener('abort', function() { reject() });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                                            }

                                            $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                                            resolve({ default: response.url });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Send request
                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', '{{ $address->id ?? 0 }}');
                                        xhr.send(data);
                                    });
                                })
                        }
                    };
                }
            }

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });
    </script>

@endsection
