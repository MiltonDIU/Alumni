<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAddressRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AddressesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Address::with(['division', 'district', 'upazila', 'union', 'created_by'])->select(sprintf('%s.*', (new Address())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'address_show';
                $editGate = 'address_edit';
                $deleteGate = 'address_delete';
                $crudRoutePart = 'addresses';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('division_name', function ($row) {
                return $row->division ? $row->division->name : '';
            });

            $table->addColumn('district_name', function ($row) {
                return $row->district ? $row->district->name : '';
            });

            $table->addColumn('upazila_name', function ($row) {
                return $row->upazila ? $row->upazila->name : '';
            });

            $table->addColumn('union_name', function ($row) {
                return $row->union ? $row->union->name : '';
            });

            $table->editColumn('type_of_address', function ($row) {
                return $row->type_of_address ? Address::TYPE_OF_ADDRESS_SELECT[$row->type_of_address] : '';
            });
            $table->editColumn('view_on_publicly', function ($row) {
                return $row->view_on_publicly ? Address::VIEW_ON_PUBLICLY_SELECT[$row->view_on_publicly] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'division', 'district', 'upazila', 'union']);

            return $table->make(true);
        }

        return view('admin.addresses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('address_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Division::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.addresses.create', compact('districts', 'divisions', 'unions', 'upazilas'));
    }

    public function store(StoreAddressRequest $request)
    {
        $address = Address::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $address->id]);
        }

        return redirect()->route('admin.addresses.index');
    }

    public function edit(Address $address)
    {
        abort_if(Gate::denies('address_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Division::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $address->load('division', 'district', 'upazila', 'union', 'created_by');

        return view('admin.addresses.edit', compact('address', 'districts', 'divisions', 'unions', 'upazilas'));
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->update($request->all());

        return redirect()->route('admin.addresses.index');
    }

    public function show(Address $address)
    {
        abort_if(Gate::denies('address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->load('division', 'district', 'upazila', 'union', 'created_by');

        return view('admin.addresses.show', compact('address'));
    }

    public function destroy(Address $address)
    {
        abort_if(Gate::denies('address_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddressRequest $request)
    {
        Address::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('address_create') && Gate::denies('address_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Address();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
