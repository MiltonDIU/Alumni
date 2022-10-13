<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Http\Resources\Admin\SchoolResource;
use App\Models\School;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SchoolsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('school_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SchoolResource(School::with(['division', 'district', 'upazila', 'union'])->get());
    }

    public function store(StoreSchoolRequest $request)
    {
        $school = School::create($request->all());

        if ($request->input('picture', false)) {
            $school->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('picture');
        }

        return (new SchoolResource($school))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(School $school)
    {
        abort_if(Gate::denies('school_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SchoolResource($school->load(['division', 'district', 'upazila', 'union']));
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

        return (new SchoolResource($school))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(School $school)
    {
        abort_if(Gate::denies('school_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
