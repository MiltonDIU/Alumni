<?php

namespace App\Http\Requests;

use App\Models\FieldOfWork;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFieldOfWorkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('field_of_work_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'required',
                'unique:field_of_works,slug,' . request()->route('field_of_work')->id,
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
