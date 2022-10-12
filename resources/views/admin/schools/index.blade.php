@extends('layouts.admin')
@section('content')
    @can('school_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.schools.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.school.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'School', 'route' => 'admin.schools.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.school.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-School">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.school.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.division') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.district') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.upazila') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.union') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.picture') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.contact_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.url') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.is_active') }}
                    </th>
                    <th>
                        {{ trans('cruds.school.fields.is_approve') }}
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
            @can('school_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.schools.massDestroy') }}",
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
                ajax: "{{ route('admin.schools.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'division_name', name: 'division.name' },
                    { data: 'district_name', name: 'district.name' },
                    { data: 'upazila_name', name: 'upazila.name' },
                    { data: 'union_name', name: 'union.name' },
                    { data: 'picture', name: 'picture', sortable: false, searchable: false },
                    { data: 'email', name: 'email' },
                    { data: 'contact_number', name: 'contact_number' },
                    { data: 'url', name: 'url' },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'is_approve', name: 'is_approve' },
                    { data: 'actions', name: '{{ trans('global.actions') }}' }
                ],
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            };
            let table = $('.datatable-School').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });

    </script>
@endsection
