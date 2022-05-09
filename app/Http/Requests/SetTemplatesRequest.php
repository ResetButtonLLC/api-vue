<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetTemplatesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'descriptions' => 'array',
            'descriptions.value' => 'string',
            'descriptions.pin' => 'integer',
            'headlines' => 'array',
            'headlines.value' => 'string',
            'headlines.pin' => 'integer',
            'name' => 'string',
        ];
    }
}
