<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySchoolRequest;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\District;
use App\Models\Division;
use App\Models\School;
use App\Models\Union;
use App\Models\Upazila;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SchoolsController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('school_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = School::with(['division', 'district', 'upazila', 'union'])->select(sprintf('%s.*', (new School())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'school_show';
                $editGate = 'school_edit';
                $deleteGate = 'school_delete';
                $crudRoutePart = 'schools';

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

            $table->editColumn('picture', function ($row) {
                if ($photo = $row->picture) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('contact_number', function ($row) {
                return $row->contact_number ? $row->contact_number : '';
            });
            $table->editColumn('url', function ($row) {
                return $row->url ? $row->url : '';
            });
            $table->editColumn('is_active', function ($row) {
                return $row->is_active ? School::IS_ACTIVE_SELECT[$row->is_active] : '';
            });
            $table->editColumn('is_approve', function ($row) {
                return $row->is_approve ? School::IS_APPROVE_SELECT[$row->is_approve] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'division', 'district', 'upazila', 'union', 'picture']);

            return $table->make(true);
        }

        return view('admin.schools.index');
    }

    public function create()
    {
        abort_if(Gate::denies('school_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Division::where('is_active','1')->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.schools.create', compact('districts', 'divisions', 'unions', 'upazilas'));
    }

    public function store(StoreSchoolRequest $request)
    {
        $school = School::create($request->all());

        if ($request->input('picture', false)) {
            $school->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('picture');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $school->id]);
        }

        return redirect()->route('admin.schools.index');
    }

    public function edit(School $school)
    {
        abort_if(Gate::denies('school_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $divisions = Division::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $school->load('division', 'district', 'upazila', 'union');

        return view('admin.schools.edit', compact('districts', 'divisions', 'school', 'unions', 'upazilas'));
    }

    public function update(UpdateSchoolRequest $request, School $school)
    {
        $school->update($request->all());

        if ($request->input('picture', false)) {
            if (!$school->picture || $request->input('picture') !== $school->picture->file_name) {
                if ($school->picture) {
                    $school->picture->delete();
                }
                $school->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('picture');
            }
        } elseif ($school->picture) {
            $school->picture->delete();
        }

        return redirect()->route('admin.schools.index');
    }

    public function show(School $school)
    {
        abort_if(Gate::denies('school_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school->load('division', 'district', 'upazila', 'union', 'schoolUsers', 'schoolEvents');

        return view('admin.schools.show', compact('school'));
    }

    public function destroy(School $school)
    {
        abort_if(Gate::denies('school_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school->delete();

        return back();
    }

    public function massDestroy(MassDestroySchoolRequest $request)
    {
        School::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('school_create') && Gate::denies('school_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new School();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
