@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.school.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.schools.update", [$school->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.school.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $school->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="slug">{{ trans('cruds.school.fields.slug') }}</label>
                    <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', $school->slug) }}" required>
                    @if($errors->has('slug'))
                        <div class="invalid-feedback">
                            {{ $errors->first('slug') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.slug_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="division_id">{{ trans('cruds.school.fields.division') }}</label>
                    <select class="form-control select2 {{ $errors->has('division') ? 'is-invalid' : '' }}" name="division_id" id="division_id" required>
                        @foreach($divisions as $id => $entry)
                            <option value="{{ $id }}" {{ (old('division_id') ? old('division_id') : $school->division->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('division'))
                        <div class="invalid-feedback">
                            {{ $errors->first('division') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.division_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="district_id">{{ trans('cruds.school.fields.district') }}</label>
                    <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id">
                        @foreach($districts as $id => $entry)
                            <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $school->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('district'))
                        <div class="invalid-feedback">
                            {{ $errors->first('district') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.district_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="upazila_id">{{ trans('cruds.school.fields.upazila') }}</label>
                    <select class="form-control select2 {{ $errors->has('upazila') ? 'is-invalid' : '' }}" name="upazila_id" id="upazila_id">
                        @foreach($upazilas as $id => $entry)
                            <option value="{{ $id }}" {{ (old('upazila_id') ? old('upazila_id') : $school->upazila->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('upazila'))
                        <div class="invalid-feedback">
                            {{ $errors->first('upazila') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.upazila_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="union_id">{{ trans('cruds.school.fields.union') }}</label>
                    <select class="form-control select2 {{ $errors->has('union') ? 'is-invalid' : '' }}" name="union_id" id="union_id">
                        @foreach($unions as $id => $entry)
                            <option value="{{ $id }}" {{ (old('union_id') ? old('union_id') : $school->union->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('union'))
                        <div class="invalid-feedback">
                            {{ $errors->first('union') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.union_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="picture">{{ trans('cruds.school.fields.picture') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('picture') ? 'is-invalid' : '' }}" id="picture-dropzone">
                    </div>
                    @if($errors->has('picture'))
                        <div class="invalid-feedback">
                            {{ $errors->first('picture') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.picture_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="email">{{ trans('cruds.school.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $school->email) }}">
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.email_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="contact_number">{{ trans('cruds.school.fields.contact_number') }}</label>
                    <input class="form-control {{ $errors->has('contact_number') ? 'is-invalid' : '' }}" type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $school->contact_number) }}">
                    @if($errors->has('contact_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('contact_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.contact_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="about">{{ trans('cruds.school.fields.about') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('about') ? 'is-invalid' : '' }}" name="about" id="about">{!! old('about', $school->about) !!}</textarea>
                    @if($errors->has('about'))
                        <div class="invalid-feedback">
                            {{ $errors->first('about') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.about_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="url">{{ trans('cruds.school.fields.url') }}</label>
                    <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $school->url) }}">
                    @if($errors->has('url'))
                        <div class="invalid-feedback">
                            {{ $errors->first('url') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.url_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.school.fields.is_active') }}</label>
                    <select class="form-control {{ $errors->has('is_active') ? 'is-invalid' : '' }}" name="is_active" id="is_active">
                        <option value disabled {{ old('is_active', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\School::IS_ACTIVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_active', $school->is_active) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_active'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_active') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.is_active_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.school.fields.is_approve') }}</label>
                    <select class="form-control {{ $errors->has('is_approve') ? 'is-invalid' : '' }}" name="is_approve" id="is_approve">
                        <option value disabled {{ old('is_approve', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\School::IS_APPROVE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_approve', $school->is_approve) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_approve'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_approve') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.school.fields.is_approve_helper') }}</span>
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
        Dropzone.options.pictureDropzone = {
            url: '{{ route('admin.schools.storeMedia') }}',
            maxFilesize: 1, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 1,
                width: 4096,
                height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="picture"]').remove()
                $('form').append('<input type="hidden" name="picture" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="picture"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($school) && $school->picture)
                var file = {!! json_encode($school->picture) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="picture" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
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
                                        xhr.open('POST', '{{ route('admin.schools.storeCKEditorImages') }}', true);
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
                                        data.append('crud_id', '{{ $school->id ?? 0 }}');
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
