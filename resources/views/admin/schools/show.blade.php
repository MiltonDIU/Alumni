@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.school.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.schools.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.id') }}
                        </th>
                        <td>
                            {{ $school->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.name') }}
                        </th>
                        <td>
                            {{ $school->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.slug') }}
                        </th>
                        <td>
                            {{ $school->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.division') }}
                        </th>
                        <td>
                            {{ $school->division->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.district') }}
                        </th>
                        <td>
                            {{ $school->district->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.upazila') }}
                        </th>
                        <td>
                            {{ $school->upazila->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.union') }}
                        </th>
                        <td>
                            {{ $school->union->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.picture') }}
                        </th>
                        <td>
                            @if($school->picture)
                                <a href="{{ $school->picture->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $school->picture->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.email') }}
                        </th>
                        <td>
                            {{ $school->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.contact_number') }}
                        </th>
                        <td>
                            {{ $school->contact_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.about') }}
                        </th>
                        <td>
                            {!! $school->about !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.url') }}
                        </th>
                        <td>
                            {{ $school->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\School::IS_ACTIVE_SELECT[$school->is_active] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.is_approve') }}
                        </th>
                        <td>
                            {{ App\Models\School::IS_APPROVE_SELECT[$school->is_approve] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.schools.index') }}">
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
                <a class="nav-link" href="#school_users" role="tab" data-toggle="tab">
                    {{ trans('cruds.user.title') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#school_events" role="tab" data-toggle="tab">
                    {{ trans('cruds.event.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="school_users">
                @includeIf('admin.schools.relationships.schoolUsers', ['users' => $school->schoolUsers])
            </div>
            <div class="tab-pane" role="tabpanel" id="school_events">
                @includeIf('admin.schools.relationships.schoolEvents', ['events' => $school->schoolEvents])
            </div>
        </div>
    </div>

@endsection
