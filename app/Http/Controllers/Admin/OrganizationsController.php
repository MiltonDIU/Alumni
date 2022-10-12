<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOrganizationRequest;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\Organization;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrganizationsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('organization_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Organization::query()->select(sprintf('%s.*', (new Organization())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'organization_show';
                $editGate = 'organization_edit';
                $deleteGate = 'organization_delete';
                $crudRoutePart = 'organizations';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });
            $table->editColumn('is_active', function ($row) {
                return $row->is_active ? Organization::IS_ACTIVE_SELECT[$row->is_active] : '';
            });
            $table->editColumn('is_approve', function ($row) {
                return $row->is_approve ? Organization::IS_APPROVE_SELECT[$row->is_approve] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.organizations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('organization_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.organizations.create');
    }

    public function store(StoreOrganizationRequest $request)
    {
        $organization = Organization::create($request->all());

        return redirect()->route('admin.organizations.index');
    }

    public function edit(Organization $organization)
    {
        abort_if(Gate::denies('organization_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        $organization->update($request->all());

        return redirect()->route('admin.organizations.index');
    }

    public function show(Organization $organization)
    {
        abort_if(Gate::denies('organization_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organization->load('organizationWorks');

        return view('admin.organizations.show', compact('organization'));
    }

    public function destroy(Organization $organization)
    {
        abort_if(Gate::denies('organization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organization->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrganizationRequest $request)
    {
        Organization::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
