<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Batch;
use App\Models\District;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\School;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EventsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Event::with(['event_category', 'district', 'upazila', 'union', 'batches', 'schools', 'users', 'created_by'])->select(sprintf('%s.*', (new Event())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'event_show';
                $editGate = 'event_edit';
                $deleteGate = 'event_delete';
                $crudRoutePart = 'events';

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
            $table->addColumn('event_category_name', function ($row) {
                return $row->event_category ? $row->event_category->name : '';
            });

            $table->addColumn('district_name', function ($row) {
                return $row->district ? $row->district->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('upazila_name', function ($row) {
                return $row->upazila ? $row->upazila->name : '';
            });

            $table->addColumn('union_name', function ($row) {
                return $row->union ? $row->union->name : '';
            });

            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
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
            $table->editColumn('is_free', function ($row) {
                return $row->is_free ? Event::IS_FREE_SELECT[$row->is_free] : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('batch', function ($row) {
                $labels = [];
                foreach ($row->batches as $batch) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $batch->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('school', function ($row) {
                $labels = [];
                foreach ($row->schools as $school) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $school->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('event_status', function ($row) {
                return $row->event_status ? Event::EVENT_STATUS_SELECT[$row->event_status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'event_category', 'district', 'upazila', 'union', 'picture', 'batch', 'school']);

            return $table->make(true);
        }

        return view('admin.events.index');
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event_categories = EventCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::pluck('title', 'id');

        $schools = School::pluck('name', 'id');

        $users = User::pluck('name', 'id');

        return view('admin.events.create', compact('batches', 'districts', 'event_categories', 'schools', 'unions', 'upazilas', 'users'));
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        return redirect()->route('admin.events.index');
    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event_categories = EventCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $districts = District::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $upazilas = Upazila::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unions = Union::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $batches = Batch::pluck('title', 'id');

        $schools = School::pluck('name', 'id');

        $users = User::pluck('name', 'id');

        $event->load('event_category', 'district', 'upazila', 'union', 'batches', 'schools', 'users', 'created_by');

        return view('admin.events.edit', compact('batches', 'districts', 'event', 'event_categories', 'schools', 'unions', 'upazilas', 'users'));
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

        return redirect()->route('admin.events.index');
    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('event_category', 'district', 'upazila', 'union', 'batches', 'schools', 'users', 'created_by');

        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Event::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_create') && Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Event();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
