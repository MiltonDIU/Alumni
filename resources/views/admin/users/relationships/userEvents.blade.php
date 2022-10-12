@can('event_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.events.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.event.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.event.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userEvents">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.event.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.event_category') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.district') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.upazila') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.union') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.picture') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.is_free') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.price') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.batch') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.school') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.event_status') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $key => $event)
                    <tr data-entry-id="{{ $event->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $event->id ?? '' }}
                        </td>
                        <td>
                            {{ $event->event_category->name ?? '' }}
                        </td>
                        <td>
                            {{ $event->district->name ?? '' }}
                        </td>
                        <td>
                            {{ $event->name ?? '' }}
                        </td>
                        <td>
                            {{ $event->upazila->name ?? '' }}
                        </td>
                        <td>
                            {{ $event->union->name ?? '' }}
                        </td>
                        <td>
                            {{ $event->address ?? '' }}
                        </td>
                        <td>
                            @if($event->picture)
                                <a href="{{ $event->picture->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $event->picture->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                        <td>
                            {{ App\Models\Event::IS_FREE_SELECT[$event->is_free] ?? '' }}
                        </td>
                        <td>
                            {{ $event->price ?? '' }}
                        </td>
                        <td>
                            @foreach($event->batches as $key => $item)
                                <span class="badge badge-info">{{ $item->title }}</span>
                            @endforeach
                        </td>
                        <td>
                            @foreach($event->schools as $key => $item)
                                <span class="badge badge-info">{{ $item->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            {{ App\Models\Event::EVENT_STATUS_SELECT[$event->event_status] ?? '' }}
                        </td>
                        <td>
                            @can('event_show')
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.events.show', $event->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                            @endcan

                            @can('event_edit')
                                <a class="btn btn-xs btn-info" href="{{ route('admin.events.edit', $event->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                            @endcan

                            @can('event_delete')
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                            @endcan

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('event_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.events.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            });
            let table = $('.datatable-userEvents:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection