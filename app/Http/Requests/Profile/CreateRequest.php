<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\ApiRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class CreateRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'project_id' => 'required|integer|exists:projects,id',
            'name' => 'required|string|min:2|max:100|unique:profiles,name'
        ];
    }

}
