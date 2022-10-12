<?php

namespace App\Http\Requests;

use App\Models\Union;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUnionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('union_create');
    }

    public function rules()
    {
        return [
            'upazila_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'required',
            ],
            'bn_name' => [
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
