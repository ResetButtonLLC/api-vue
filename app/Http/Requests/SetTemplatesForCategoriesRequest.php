<?php

namespace App\Http\Requests;

class SetTemplatesForCategoriesRequest extends SetTemplatesRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'categories' => 'array',
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
