<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_edit');
    }

    public function rules()
    {
        return [
            'event_category_id' => [
                'required',
                'integer',
            ],
            'district_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'upazila_id' => [
                'required',
                'integer',
            ],
            'summary' => [
                'required',
            ],
            'details' => [
                'required',
            ],
            'picture' => [
                'required',
            ],
            'price' => [
                'string',
                'nullable',
            ],
            'batches.*' => [
                'integer',
            ],
            'batches' => [
                'array',
            ],
            'schools.*' => [
                'integer',
            ],
            'schools' => [
                'array',
            ],
            'users.*' => [
                'integer',
            ],
            'users' => [
                'array',
            ],
            'event_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'event_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
        ];
    }
}
