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
            'projectId' => 'required|integer',
            'name' => 'required|string|min:2|max:100'
        ];
    }

    public function getName()
    {
        return $this->input('name');
    }

    public function getprojectId()
    {
        return $this->input('projectId');
    }

    public function getproject()
    {
        return Project::where(['id' => $this->getprojectId(), 'user_id' => Auth::id()])->firstOrFail();
    }
}
