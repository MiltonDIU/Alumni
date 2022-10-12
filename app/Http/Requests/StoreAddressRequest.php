<?php

namespace App\Http\Requests;

use App\Models\Address;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAddressRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('address_create');
    }

    public function rules()
    {
        return [
            'area' => [
                'required',
            ],
            'type_of_address' => [
                'required',
            ],
            'view_on_publicly' => [
                'required',
            ],
        ];
    }
}