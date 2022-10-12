<?php

namespace App\Http\Requests;

use App\Models\Batch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBatchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('batch_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
                'unique:batches,title,' . request()->route('batch')->id,
            ],
            'slug' => [
                'string',
                'required',
                'unique:batches,slug,' . request()->route('batch')->id,
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
