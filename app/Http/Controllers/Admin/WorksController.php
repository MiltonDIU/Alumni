<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkRequest;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Designation;
use App\Models\FieldOfWork;
use App\Models\Organization;
use App\Models\Work;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorksController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('work_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Work::with(['field_of_work', 'organization', 'designation', 'created_by'])->select(sprintf('%s.*', (new Work())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'work_show';
                $editGate = 'work_edit';
                $deleteGate = 'work_delete';
                $crudRoutePart = 'works';

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
            $table->addColumn('field_of_work_name', function ($row) {
                return $row->field_of_work ? $row->field_of_work->name : '';
            });

            $table->addColumn('organization_name', function ($row) {
                return $row->organization ? $row->organization->name : '';
            });

            $table->addColumn('designation_name', function ($row) {
                return $row->designation ? $row->designation->name : '';
            });

            $table->editColumn('is_current_job', function ($row) {
                return $row->is_current_job ? Work::IS_CURRENT_JOB_SELECT[$row->is_current_job] : '';
            });
            $table->editColumn('view_on_publicly', function ($row) {
                return $row->view_on_publicly ? Work::VIEW_ON_PUBLICLY_SELECT[$row->view_on_publicly] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'field_of_work', 'organization', 'designation']);

            return $table->make(true);
        }

        return view('admin.works.index');
    }

    public function create()
    {
        abort_if(Gate::denies('work_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_of_works = FieldOfWork::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $organizations = Organization::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $designations = Designation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.works.create', compact('designations', 'field_of_works', 'organizations'));
    }

    public function store(StoreWorkRequest $request)
    {
        $work = Work::create($request->all());

        return redirect()->route('admin.works.index');
    }

    public function edit(Work $work)
    {
        abort_if(Gate::denies('work_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $field_of_works = FieldOfWork::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $organizations = Organization::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $designations = Designation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $work->load('field_of_work', 'organization', 'designation', 'created_by');

        return view('admin.works.edit', compact('designations', 'field_of_works', 'organizations', 'work'));
    }

    public function update(UpdateWorkRequest $request, Work $work)
    {
        $work->update($request->all());

        return redirect()->route('admin.works.index');
    }

    public function show(Work $work)
    {
        abort_if(Gate::denies('work_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $work->load('field_of_work', 'organization', 'designation', 'created_by');

        return view('admin.works.show', compact('work'));
    }

    public function destroy(Work $work)
    {
        abort_if(Gate::denies('work_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $work->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkRequest $request)
    {
        Work::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
