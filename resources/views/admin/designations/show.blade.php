@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.designation.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.designations.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.designation.fields.id') }}
                        </th>
                        <td>
                            {{ $designation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.designation.fields.name') }}
                        </th>
                        <td>
                            {{ $designation->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.designation.fields.slug') }}
                        </th>
                        <td>
                            {{ $designation->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.designation.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Designation::IS_ACTIVE_SELECT[$designation->is_active] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.designation.fields.is_approve') }}
                        </th>
                        <td>
                            {{ App\Models\Designation::IS_APPROVE_SELECT[$designation->is_approve] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.designations.index') }}">
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
                <a class="nav-link" href="#designation_works" role="tab" data-toggle="tab">
                    {{ trans('cruds.work.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="designation_works">
                @includeIf('admin.designations.relationships.designationWorks', ['works' => $designation->designationWorks])
            </div>
        </div>
    </div>

@endsection
