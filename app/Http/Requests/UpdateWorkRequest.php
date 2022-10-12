<?php

namespace App\Http\Requests;

use App\Models\Work;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWorkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('work_edit');
    }

    public function rules()
    {
        return [
            'field_of_work_id' => [
                'required',
                'integer',
            ],
            'organization_id' => [
                'required',
                'integer',
            ],
            'designation_id' => [
                'required',
                'integer',
            ],
            'joining_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'resign_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'is_current_job' => [
                'required',
            ],
            'view_on_publicly' => [
                'required',
            ],
        ];
    }
}
