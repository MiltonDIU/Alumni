@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.event.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <td>
                            {{ $event->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.event_category') }}
                        </th>
                        <td>
                            {{ $event->event_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.district') }}
                        </th>
                        <td>
                            {{ $event->district->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.name') }}
                        </th>
                        <td>
                            {{ $event->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.upazila') }}
                        </th>
                        <td>
                            {{ $event->upazila->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.union') }}
                        </th>
                        <td>
                            {{ $event->union->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.address') }}
                        </th>
                        <td>
                            {{ $event->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.summary') }}
                        </th>
                        <td>
                            {{ $event->summary }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.details') }}
                        </th>
                        <td>
                            {!! $event->details !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.picture') }}
                        </th>
                        <td>
                            @if($event->picture)
                                <a href="{{ $event->picture->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $event->picture->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.is_free') }}
                        </th>
                        <td>
                            {{ App\Models\Event::IS_FREE_SELECT[$event->is_free] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.price') }}
                        </th>
                        <td>
                            {{ $event->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.batch') }}
                        </th>
                        <td>
                            @foreach($event->batches as $key => $batch)
                                <span class="label label-info">{{ $batch->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.school') }}
                        </th>
                        <td>
                            @foreach($event->schools as $key => $school)
                                <span class="label label-info">{{ $school->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.user') }}
                        </th>
                        <td>
                            @foreach($event->users as $key => $user)
                                <span class="label label-info">{{ $user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.event_status') }}
                        </th>
                        <td>
                            {{ App\Models\Event::EVENT_STATUS_SELECT[$event->event_status] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
