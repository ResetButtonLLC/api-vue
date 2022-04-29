<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

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
            //todo in_array
            'role' => 'required',
            'clients' => 'array|required'
        ];
    }
}
