<?php

namespace App\Http\Requests;

use App\Models\FieldOfWork;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFieldOfWorkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('field_of_work_create');
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
                'unique:field_of_works',
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
