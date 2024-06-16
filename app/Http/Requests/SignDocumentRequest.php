<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SignDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to false if authorization logic is needed
    }

    public function rules()
    {
        // Since we are just signing a document, no additional validation is required here.
        return [];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors(),
        ], 422));
    }

    public function messages()
    {
        return [];
    }
}
