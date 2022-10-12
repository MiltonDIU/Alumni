@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.organization.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.organizations.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.id') }}
                        </th>
                        <td>
                            {{ $organization->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.name') }}
                        </th>
                        <td>
                            {{ $organization->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.slug') }}
                        </th>
                        <td>
                            {{ $organization->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Organization::IS_ACTIVE_SELECT[$organization->is_active] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organization.fields.is_approve') }}
                        </th>
                        <td>
                            {{ App\Models\Organization::IS_APPROVE_SELECT[$organization->is_approve] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.organizations.index') }}">
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
                <a class="nav-link" href="#organization_works" role="tab" data-toggle="tab">
                    {{ trans('cruds.work.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="organization_works">
                @includeIf('admin.organizations.relationships.organizationWorks', ['works' => $organization->organizationWorks])
            </div>
        </div>
    </div>

@endsection
