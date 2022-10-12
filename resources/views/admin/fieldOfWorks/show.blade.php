@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.fieldOfWork.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.field-of-works.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fieldOfWork.fields.id') }}
                        </th>
                        <td>
                            {{ $fieldOfWork->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fieldOfWork.fields.name') }}
                        </th>
                        <td>
                            {{ $fieldOfWork->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fieldOfWork.fields.slug') }}
                        </th>
                        <td>
                            {{ $fieldOfWork->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fieldOfWork.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\FieldOfWork::IS_ACTIVE_SELECT[$fieldOfWork->is_active] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fieldOfWork.fields.is_approve') }}
                        </th>
                        <td>
                            {{ App\Models\FieldOfWork::IS_APPROVE_SELECT[$fieldOfWork->is_approve] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.field-of-works.index') }}">
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
                <a class="nav-link" href="#field_of_work_works" role="tab" data-toggle="tab">
                    {{ trans('cruds.work.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="field_of_work_works">
                @includeIf('admin.fieldOfWorks.relationships.fieldOfWorkWorks', ['works' => $fieldOfWork->fieldOfWorkWorks])
            </div>
        </div>
    </div>

@endsection
