<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:100|unique:projects,name'
        ];
    }

    public function getName()
    {
        return $this->input('name');
    }
}
