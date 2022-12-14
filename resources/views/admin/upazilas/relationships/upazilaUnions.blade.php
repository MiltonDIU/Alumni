@can('union_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.unions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.union.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.union.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-upazilaUnions">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.union.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.union.fields.upazila') }}
                    </th>
                    <th>
                        {{ trans('cruds.union.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.union.fields.url') }}
                    </th>
                    <th>
                        {{ trans('cruds.union.fields.is_active') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($unions as $key => $union)
                    <tr data-entry-id="{{ $union->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $union->id ?? '' }}
                        </td>
                        <td>
                            {{ $union->upazila->name ?? '' }}
                        </td>
                        <td>
                            {{ $union->name ?? '' }}
                        </td>
                        <td>
                            {{ $union->url ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\Union::IS_ACTIVE_SELECT[$union->is_active] ?? '' }}
                        </td>
                        <td>
                            @can('union_show')
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.unions.show', $union->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                            @endcan

                            @can('union_edit')
                                <a class="btn btn-xs btn-info" href="{{ route('admin.unions.edit', $union->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                            @endcan

                            @can('union_delete')
                                <form action="{{ route('admin.unions.destroy', $union->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
            @can('union_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.unions.massDestroy') }}",
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
            let table = $('.datatable-upazilaUnions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })

    </script>
@endsection
