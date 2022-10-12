@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.work.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.works.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.id') }}
                        </th>
                        <td>
                            {{ $work->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.field_of_work') }}
                        </th>
                        <td>
                            {{ $work->field_of_work->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.organization') }}
                        </th>
                        <td>
                            {{ $work->organization->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.designation') }}
                        </th>
                        <td>
                            {{ $work->designation->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.joining_date') }}
                        </th>
                        <td>
                            {{ $work->joining_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.resign_date') }}
                        </th>
                        <td>
                            {{ $work->resign_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.is_current_job') }}
                        </th>
                        <td>
                            {{ App\Models\Work::IS_CURRENT_JOB_SELECT[$work->is_current_job] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.work.fields.view_on_publicly') }}
                        </th>
                        <td>
                            {{ App\Models\Work::VIEW_ON_PUBLICLY_SELECT[$work->view_on_publicly] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.works.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
