@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.address.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.addresses.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.id') }}
                        </th>
                        <td>
                            {{ $address->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.division') }}
                        </th>
                        <td>
                            {{ $address->division->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.district') }}
                        </th>
                        <td>
                            {{ $address->district->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.upazila') }}
                        </th>
                        <td>
                            {{ $address->upazila->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.union') }}
                        </th>
                        <td>
                            {{ $address->union->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.area') }}
                        </th>
                        <td>
                            {!! $address->area !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.type_of_address') }}
                        </th>
                        <td>
                            {{ App\Models\Address::TYPE_OF_ADDRESS_SELECT[$address->type_of_address] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.view_on_publicly') }}
                        </th>
                        <td>
                            {{ App\Models\Address::VIEW_ON_PUBLICLY_SELECT[$address->view_on_publicly] ?? '' }}
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.addresses.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
