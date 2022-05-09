<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PreviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'filters' => 'array',
            'page' => 'integer|min:1',
        ];
    }

    public function getPage()
    {
        return $this->input('page', 1);
    }

    public function getFilters()
    {
        return $this->input('filters', []);
    }
}
