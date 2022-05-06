<?php

namespace App\Http\Requests;

use App\Http\Responses\Errors\Validation as ValidationError;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        return new ValidationError($validator->errors()->all());
    }

}
