<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Http\Resources\Admin\WorkResource;
use App\Models\Work;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorksApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('work_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkResource(Work::with(['field_of_work', 'organization', 'designation', 'created_by'])->get());
    }

    public function store(StoreWorkRequest $request)
    {
        $work = Work::create($request->all());

        return (new WorkResource($work))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Work $work)
    {
        abort_if(Gate::denies('work_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkResource($work->load(['field_of_work', 'organization', 'designation', 'created_by']));
    }

    public function update(UpdateWorkRequest $request, Work $work)
    {
        $work->update($request->all());

        return (new WorkResource($work))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Work $work)
    {
        abort_if(Gate::denies('work_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $work->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
