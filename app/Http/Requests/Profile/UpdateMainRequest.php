<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;

class UpdateMainRequest  extends ApiRequest
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
            'google_ads_account_id' =>  'required|integer|between:1000000000,9999999999',
            'activity' =>  'required|boolean',
            //todo сейчас с фронта передает то с точкой, то без, а валидация numeric не совсем то что нужно
            'bid' => [
                'regex:/(\d+\.\d{1,2}|\d+)/'
            ]

        ];
    }
}
