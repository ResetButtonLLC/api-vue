<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends ApiRequest
{

    public function authorize() : bool
    {
        //Обновлять пользователей из проекта может только администратор, поэтому если есть массив с добавлением пользователей, то проверяем права
        if (request()->get('users',[])) {
            return auth()->user()->isAdmin();
        } else {
            return true;
        }
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                Rule::unique($this->route('project')->getTable())->ignore($this->route('project')),
            ]
        ];
    }
}
