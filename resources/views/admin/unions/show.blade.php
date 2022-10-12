@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.union.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.unions.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.union.fields.id') }}
                        </th>
                        <td>
                            {{ $union->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.union.fields.upazila') }}
                        </th>
                        <td>
                            {{ $union->upazila->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.union.fields.name') }}
                        </th>
                        <td>
                            {{ $union->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.union.fields.slug') }}
                        </th>
                        <td>
                            {{ $union->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.union.fields.bn_name') }}
                        </th>
                        <td>
                            {{ $union->bn_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.union.fields.url') }}
                        </th>
                        <td>
                            {{ $union->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.union.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Union::IS_ACTIVE_SELECT[$union->is_active] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.unions.index') }}">
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
                <a class="nav-link" href="#union_schools" role="tab" data-toggle="tab">
                    {{ trans('cruds.school.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#union_addresses" role="tab" data-toggle="tab">
                    {{ trans('cruds.address.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#union_events" role="tab" data-toggle="tab">
                    {{ trans('cruds.event.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="union_schools">
                @includeIf('admin.unions.relationships.unionSchools', ['schools' => $union->unionSchools])
            </div>
            <div class="tab-pane" role="tabpanel" id="union_addresses">
                @includeIf('admin.unions.relationships.unionAddresses', ['addresses' => $union->unionAddresses])
            </div>
            <div class="tab-pane" role="tabpanel" id="union_events">
                @includeIf('admin.unions.relationships.unionEvents', ['events' => $union->unionEvents])
            </div>
        </div>
    </div>

@endsection
