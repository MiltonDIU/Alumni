@extends('layouts.admin')
@section('content')
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
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Event">
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
            </table>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('event_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.events.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                        return entry.id
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

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.events.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'event_category_name', name: 'event_category.name' },
                    { data: 'district_name', name: 'district.name' },
                    { data: 'name', name: 'name' },
                    { data: 'upazila_name', name: 'upazila.name' },
                    { data: 'union_name', name: 'union.name' },
                    { data: 'address', name: 'address' },
                    { data: 'picture', name: 'picture', sortable: false, searchable: false },
                    { data: 'is_free', name: 'is_free' },
                    { data: 'price', name: 'price' },
                    { data: 'batch', name: 'batches.title' },
                    { data: 'school', name: 'schools.name' },
                    { data: 'event_status', name: 'event_status' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-Event').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
