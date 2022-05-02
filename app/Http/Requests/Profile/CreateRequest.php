<?php

namespace App\Http\Requests\Profile;

use App\Http\Requests\ApiRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class CreateRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'clientId' => 'required|integer',
            'name' => 'required|string|min:2|max:100'
        ];
    }

    public function getName()
    {
        return $this->input('name');
    }

    public function getClientId()
    {
        return $this->input('clientId');
    }

    public function getClient()
    {
        return Client::where(['id' => $this->getClientId(), 'user_id' => Auth::id()])->firstOrFail();
    }
}
