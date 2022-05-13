<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class UpdateRequest extends ApiRequest
{

    public function authorize() : bool
    {
        //Обновлять пользователей из ендпоинта проекта может только пользователь с правами на это, поэтому если есть массив с добавлением пользователей, то проверяем это
        if (request()->get('users',[])) {
            return $this->user()->can('user.management', $this->project);
        }

        return true;
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
            ],
            'users' => 'array',
            'users.*' => 'integer'
        ];
    }
}
