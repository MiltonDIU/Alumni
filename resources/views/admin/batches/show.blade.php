@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.batch.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.batches.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.id') }}
                        </th>
                        <td>
                            {{ $batch->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.title') }}
                        </th>
                        <td>
                            {{ $batch->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.slug') }}
                        </th>
                        <td>
                            {{ $batch->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.batch.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Batch::IS_ACTIVE_SELECT[$batch->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.batches.index') }}">
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
                <a class="nav-link" href="#batch_users" role="tab" data-toggle="tab">
                    {{ trans('cruds.user.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#batch_events" role="tab" data-toggle="tab">
                    {{ trans('cruds.event.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="batch_users">
                @includeIf('admin.batches.relationships.batchUsers', ['users' => $batch->batchUsers])
            </div>
            <div class="tab-pane" role="tabpanel" id="batch_events">
                @includeIf('admin.batches.relationships.batchEvents', ['events' => $batch->batchEvents])
            </div>
        </div>
    </div>

@endsection
