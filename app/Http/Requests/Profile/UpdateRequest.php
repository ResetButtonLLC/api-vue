<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\ApiRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:100|unique:profiles,name' //todo уникальный в рамках проекта
        ];
    }

}
