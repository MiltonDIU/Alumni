<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email,' . request()->route('user')->id,
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'mobile' => [
                'string',
                'nullable',
            ],
            'date_of_birth' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'batch_id' => [
                'required',
                'integer',
            ],
            'school_id' => [
                'required',
                'integer',
            ],
            'gender' => [
                'required',
            ],
        ];
    }
}
