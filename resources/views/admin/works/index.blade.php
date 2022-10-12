@extends('layouts.admin')
@section('content')
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
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Work">
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
            </table>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('work_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.works.massDestroy') }}",
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
                ajax: "{{ route('admin.works.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'field_of_work_name', name: 'field_of_work.name' },
                    { data: 'organization_name', name: 'organization.name' },
                    { data: 'designation_name', name: 'designation.name' },
                    { data: 'joining_date', name: 'joining_date' },
                    { data: 'resign_date', name: 'resign_date' },
                    { data: 'is_current_job', name: 'is_current_job' },
                    { data: 'view_on_publicly', name: 'view_on_publicly' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-Work').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
