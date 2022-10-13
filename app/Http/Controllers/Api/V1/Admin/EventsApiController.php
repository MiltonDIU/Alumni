<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\Admin\EventResource;
use App\Models\Event;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventResource(Event::with(['event_category', 'district', 'upazila', 'union', 'batches', 'schools', 'users', 'created_by'])->get());
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());
        $event->batches()->sync($request->input('batches', []));
        $event->schools()->sync($request->input('schools', []));
        $event->users()->sync($request->input('users', []));
        if ($request->input('picture', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('picture');
        }

        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventResource($event->load(['event_category', 'district', 'upazila', 'union', 'batches', 'schools', 'users', 'created_by']));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());
        $event->batches()->sync($request->input('batches', []));
        $event->schools()->sync($request->input('schools', []));
        $event->users()->sync($request->input('users', []));
        if ($request->input('picture', false)) {
            if (!$event->picture || $request->input('picture') !== $event->picture->file_name) {
                if ($event->picture) {
                    $event->picture->delete();
                }
                $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('picture');
            }
        } elseif ($event->picture) {
            $event->picture->delete();
        }

        return (new EventResource($event))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
