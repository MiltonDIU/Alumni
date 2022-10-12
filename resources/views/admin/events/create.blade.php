@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.event.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.events.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="event_category_id">{{ trans('cruds.event.fields.event_category') }}</label>
                    <select class="form-control select2 {{ $errors->has('event_category') ? 'is-invalid' : '' }}" name="event_category_id" id="event_category_id" required>
                        @foreach($event_categories as $id => $entry)
                            <option value="{{ $id }}" {{ old('event_category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('event_category'))
                        <div class="invalid-feedback">
                            {{ $errors->first('event_category') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.event_category_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="district_id">{{ trans('cruds.event.fields.district') }}</label>
                    <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id" required>
                        @foreach($districts as $id => $entry)
                            <option value="{{ $id }}" {{ old('district_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('district'))
                        <div class="invalid-feedback">
                            {{ $errors->first('district') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.district_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.event.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="upazila_id">{{ trans('cruds.event.fields.upazila') }}</label>
                    <select class="form-control select2 {{ $errors->has('upazila') ? 'is-invalid' : '' }}" name="upazila_id" id="upazila_id" required>
                        @foreach($upazilas as $id => $entry)
                            <option value="{{ $id }}" {{ old('upazila_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('upazila'))
                        <div class="invalid-feedback">
                            {{ $errors->first('upazila') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.upazila_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="union_id">{{ trans('cruds.event.fields.union') }}</label>
                    <select class="form-control select2 {{ $errors->has('union') ? 'is-invalid' : '' }}" name="union_id" id="union_id">
                        @foreach($unions as $id => $entry)
                            <option value="{{ $id }}" {{ old('union_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('union'))
                        <div class="invalid-feedback">
                            {{ $errors->first('union') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.union_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="address">{{ trans('cruds.event.fields.address') }}</label>
                    <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address') }}</textarea>
                    @if($errors->has('address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.address_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="summary">{{ trans('cruds.event.fields.summary') }}</label>
                    <textarea class="form-control {{ $errors->has('summary') ? 'is-invalid' : '' }}" name="summary" id="summary" required>{{ old('summary') }}</textarea>
                    @if($errors->has('summary'))
                        <div class="invalid-feedback">
                            {{ $errors->first('summary') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.summary_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="details">{{ trans('cruds.event.fields.details') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('details') ? 'is-invalid' : '' }}" name="details" id="details">{!! old('details') !!}</textarea>
                    @if($errors->has('details'))
                        <div class="invalid-feedback">
                            {{ $errors->first('details') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.details_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="picture">{{ trans('cruds.event.fields.picture') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('picture') ? 'is-invalid' : '' }}" id="picture-dropzone">
                    </div>
                    @if($errors->has('picture'))
                        <div class="invalid-feedback">
                            {{ $errors->first('picture') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.picture_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.event.fields.is_free') }}</label>
                    <select class="form-control {{ $errors->has('is_free') ? 'is-invalid' : '' }}" name="is_free" id="is_free">
                        <option value disabled {{ old('is_free', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Event::IS_FREE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('is_free', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('is_free'))
                        <div class="invalid-feedback">
                            {{ $errors->first('is_free') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.is_free_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="price">{{ trans('cruds.event.fields.price') }}</label>
                    <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text" name="price" id="price" value="{{ old('price', '') }}">
                    @if($errors->has('price'))
                        <div class="invalid-feedback">
                            {{ $errors->first('price') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.price_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="batches">{{ trans('cruds.event.fields.batch') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('batches') ? 'is-invalid' : '' }}" name="batches[]" id="batches" multiple>
                        @foreach($batches as $id => $batch)
                            <option value="{{ $id }}" {{ in_array($id, old('batches', [])) ? 'selected' : '' }}>{{ $batch }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('batches'))
                        <div class="invalid-feedback">
                            {{ $errors->first('batches') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.batch_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="schools">{{ trans('cruds.event.fields.school') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('schools') ? 'is-invalid' : '' }}" name="schools[]" id="schools" multiple>
                        @foreach($schools as $id => $school)
                            <option value="{{ $id }}" {{ in_array($id, old('schools', [])) ? 'selected' : '' }}>{{ $school }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('schools'))
                        <div class="invalid-feedback">
                            {{ $errors->first('schools') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.school_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="users">{{ trans('cruds.event.fields.user') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]" id="users" multiple>
                        @foreach($users as $id => $user)
                            <option value="{{ $id }}" {{ in_array($id, old('users', [])) ? 'selected' : '' }}>{{ $user }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('users'))
                        <div class="invalid-feedback">
                            {{ $errors->first('users') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.user_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.event.fields.event_status') }}</label>
                    <select class="form-control {{ $errors->has('event_status') ? 'is-invalid' : '' }}" name="event_status" id="event_status">
                        <option value disabled {{ old('event_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Event::EVENT_STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('event_status', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('event_status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('event_status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.event_status_helper') }}</span>
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
                                        xhr.open('POST', '{{ route('admin.events.storeCKEditorImages') }}', true);
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
                                        data.append('crud_id', '{{ $event->id ?? 0 }}');
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

    <script>
        Dropzone.options.pictureDropzone = {
            url: '{{ route('admin.events.storeMedia') }}',
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
                @if(isset($event) && $event->picture)
                var file = {!! json_encode($event->picture) !!}
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
@endsection
