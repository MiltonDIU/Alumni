<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFieldOfWorkRequest;
use App\Http\Requests\UpdateFieldOfWorkRequest;
use App\Http\Resources\Admin\FieldOfWorkResource;
use App\Models\FieldOfWork;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FieldOfWorksApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('field_of_work_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FieldOfWorkResource(FieldOfWork::all());
    }

    public function store(StoreFieldOfWorkRequest $request)
    {
        $fieldOfWork = FieldOfWork::create($request->all());

        return (new FieldOfWorkResource($fieldOfWork))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(FieldOfWork $fieldOfWork)
    {
        abort_if(Gate::denies('field_of_work_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FieldOfWorkResource($fieldOfWork);
    }

    public function update(UpdateFieldOfWorkRequest $request, FieldOfWork $fieldOfWork)
    {
        $fieldOfWork->update($request->all());

        return (new FieldOfWorkResource($fieldOfWork))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(FieldOfWork $fieldOfWork)
    {
        abort_if(Gate::denies('field_of_work_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fieldOfWork->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
