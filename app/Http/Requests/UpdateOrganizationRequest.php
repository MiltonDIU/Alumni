<?php

namespace App\Http\Requests;

use App\Models\Organization;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrganizationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('organization_edit');
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
                'unique:organizations,slug,' . request()->route('organization')->id,
            ],
            'is_active' => [
                'required',
            ],
        ];
    }
}
