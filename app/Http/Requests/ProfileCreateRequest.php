<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

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
