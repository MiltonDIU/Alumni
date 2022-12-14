<?php

namespace App\Http\Requests;

use App\Models\School;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSchoolRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('school_edit');
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
            ],
            'division_id' => [
                'required',
                'integer',
            ],
            'email' => [
                'string',
                'nullable',
            ],
            'contact_number' => [
                'string',
                'nullable',
            ],
            'url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
