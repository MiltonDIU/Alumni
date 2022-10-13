<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnionRequest;
use App\Http\Requests\UpdateUnionRequest;
use App\Http\Resources\Admin\UnionResource;
use App\Models\Union;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UnionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('union_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UnionResource(Union::with(['upazila'])->get());
    }

    public function store(StoreUnionRequest $request)
    {
        $union = Union::create($request->all());

        return (new UnionResource($union))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Union $union)
    {
        abort_if(Gate::denies('union_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UnionResource($union->load(['upazila']));
    }

    public function update(UpdateUnionRequest $request, Union $union)
    {
        $union->update($request->all());

        return (new UnionResource($union))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Union $union)
    {
        abort_if(Gate::denies('union_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $union->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
