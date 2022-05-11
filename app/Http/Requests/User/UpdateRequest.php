<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UpdateRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => [
                'required',
                 Rule::in([User::ROLE_ADMIN,User::ROLE_USER]),
             ],
            'projects' => 'array|required',
            'projects.*' => 'integer'
        ];
    }
}
