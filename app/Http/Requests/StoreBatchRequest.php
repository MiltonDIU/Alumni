<?php

namespace App\Http\Requests;

use App\Models\Batch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBatchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('batch_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:batches',
            ],
            'slug' => [
                'string',
                'required',
                'unique:batches',
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
