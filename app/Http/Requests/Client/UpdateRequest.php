<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                Rule::unique($this->route('client')->getTable())->ignore($this->route('client')),
            ]
        ];
    }
}
