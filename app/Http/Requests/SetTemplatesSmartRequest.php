<?php

namespace App\Http\Requests;

class SetTemplatesSmartRequest extends SetTemplatesRequest
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
