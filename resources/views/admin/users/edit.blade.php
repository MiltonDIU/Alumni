@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="first_name">{{ trans('cruds.user.fields.first_name') }}</label>
                    <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                    @if($errors->has('first_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('first_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.first_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                    <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                    @if($errors->has('last_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('last_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                        @foreach($roles as $id => $role)
                            <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('roles'))
                        <div class="invalid-feedback">
                            {{ $errors->first('roles') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="mobile">{{ trans('cruds.user.fields.mobile') }}</label>
                    <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', $user->mobile) }}">
                    @if($errors->has('mobile'))
                        <div class="invalid-feedback">
                            {{ $errors->first('mobile') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.mobile_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="date_of_birth">{{ trans('cruds.user.fields.date_of_birth') }}</label>
                    <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" required>
                    @if($errors->has('date_of_birth'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date_of_birth') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.date_of_birth_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="avatar">{{ trans('cruds.user.fields.avatar') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('avatar') ? 'is-invalid' : '' }}" id="avatar-dropzone">
                    </div>
                    @if($errors->has('avatar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('avatar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.avatar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="batch_id">{{ trans('cruds.user.fields.batch') }}</label>
                    <select class="form-control select2 {{ $errors->has('batch') ? 'is-invalid' : '' }}" name="batch_id" id="batch_id" required>
                        @foreach($batches as $id => $entry)
                            <option value="{{ $id }}" {{ (old('batch_id') ? old('batch_id') : $user->batch->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('batch'))
                        <div class="invalid-feedback">
                            {{ $errors->first('batch') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.batch_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="school_id">{{ trans('cruds.user.fields.school') }}</label>
                    <select class="form-control select2 {{ $errors->has('school') ? 'is-invalid' : '' }}" name="school_id" id="school_id" required>
                        @foreach($schools as $id => $entry)
                            <option value="{{ $id }}" {{ (old('school_id') ? old('school_id') : $user->school->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('school'))
                        <div class="invalid-feedback">
                            {{ $errors->first('school') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.school_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.user.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\User::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('gender', $user->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <div class="invalid-feedback">
                            {{ $errors->first('gender') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.gender_helper') }}</span>
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
        Dropzone.options.avatarDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
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
                $('form').find('input[name="avatar"]').remove()
                $('form').append('<input type="hidden" name="avatar" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="avatar"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($user) && $user->avatar)
                var file = {!! json_encode($user->avatar) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="avatar" value="' + file.file_name + '">')
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
