@can('work_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.works.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.work.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.work.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-organizationWorks">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.work.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.work.fields.field_of_work') }}
                    </th>
                    <th>
                        {{ trans('cruds.work.fields.organization') }}
                    </th>
                    <th>
                        {{ trans('cruds.work.fields.designation') }}
                    </th>
                    <th>
                        {{ trans('cruds.work.fields.joining_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.work.fields.resign_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.work.fields.is_current_job') }}
                    </th>
                    <th>
                        {{ trans('cruds.work.fields.view_on_publicly') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($works as $key => $work)
                    <tr data-entry-id="{{ $work->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $work->id ?? '' }}
                        </td>
                        <td>
                            {{ $work->field_of_work->name ?? '' }}
                        </td>
                        <td>
                            {{ $work->organization->name ?? '' }}
                        </td>
                        <td>
                            {{ $work->designation->name ?? '' }}
                        </td>
                        <td>
                            {{ $work->joining_date ?? '' }}
                        </td>
                        <td>
                            {{ $work->resign_date ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\Work::IS_CURRENT_JOB_SELECT[$work->is_current_job] ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\Work::VIEW_ON_PUBLICLY_SELECT[$work->view_on_publicly] ?? '' }}
                        </td>
                        <td>
                            @can('work_show')
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.works.show', $work->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                            @endcan

                            @can('work_edit')
                                <a class="btn btn-xs btn-info" href="{{ route('admin.works.edit', $work->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                            @endcan

                            @can('work_delete')
                                <form action="{{ route('admin.works.destroy', $work->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            @can('work_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.works.massDestroy') }}",
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
            let table = $('.datatable-organizationWorks:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
