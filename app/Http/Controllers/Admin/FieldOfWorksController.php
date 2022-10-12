<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFieldOfWorkRequest;
use App\Http\Requests\StoreFieldOfWorkRequest;
use App\Http\Requests\UpdateFieldOfWorkRequest;
use App\Models\FieldOfWork;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FieldOfWorksController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('field_of_work_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = FieldOfWork::query()->select(sprintf('%s.*', (new FieldOfWork())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'field_of_work_show';
                $editGate = 'field_of_work_edit';
                $deleteGate = 'field_of_work_delete';
                $crudRoutePart = 'field-of-works';

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
                return $row->is_active ? FieldOfWork::IS_ACTIVE_SELECT[$row->is_active] : '';
            });
            $table->editColumn('is_approve', function ($row) {
                return $row->is_approve ? FieldOfWork::IS_APPROVE_SELECT[$row->is_approve] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.fieldOfWorks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('field_of_work_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fieldOfWorks.create');
    }

    public function store(StoreFieldOfWorkRequest $request)
    {
        $fieldOfWork = FieldOfWork::create($request->all());

        return redirect()->route('admin.field-of-works.index');
    }

    public function edit(FieldOfWork $fieldOfWork)
    {
        abort_if(Gate::denies('field_of_work_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fieldOfWorks.edit', compact('fieldOfWork'));
    }

    public function update(UpdateFieldOfWorkRequest $request, FieldOfWork $fieldOfWork)
    {
        $fieldOfWork->update($request->all());

        return redirect()->route('admin.field-of-works.index');
    }

    public function show(FieldOfWork $fieldOfWork)
    {
        abort_if(Gate::denies('field_of_work_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fieldOfWork->load('fieldOfWorkWorks');

        return view('admin.fieldOfWorks.show', compact('fieldOfWork'));
    }

    public function destroy(FieldOfWork $fieldOfWork)
    {
        abort_if(Gate::denies('field_of_work_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fieldOfWork->delete();

        return back();
    }

    public function massDestroy(MassDestroyFieldOfWorkRequest $request)
    {
        FieldOfWork::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
