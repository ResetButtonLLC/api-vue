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
                'string',
                'min:2',
                'max:100',
                Rule::unique($this->route('profile')->getTable())->ignore($this->route('profile'))
                ],
            //Общие настройки
            'google_ads_account_id' =>  'integer|between:1000000000,9999999999',
            'activity' =>  'boolean',
            //todo может на фронте передавать с точкой все?
            'bid' => [
                'regex:/(\d+\.\d{1,2}|\d+)/'
                ]
            //Импорт и фильтрация


        ];
    }

}
