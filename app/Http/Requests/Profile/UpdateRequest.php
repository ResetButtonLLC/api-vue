<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\ApiRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
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
                Rule::unique($this->route('profile')->getTable())->ignore($this->route('profile'))
                ],
            //todo передавать с фронта только цифры
            'google_id' =>  'required|integer|between:1000000000,9999999999',
            'activity' =>  'required|boolean',
            //todo передавать с точкой с фронта
            'bid' => [
                'required',
                'regex:/(\d+\.\d{1,2}|\d+)/'
                ]
        ];
    }

}
