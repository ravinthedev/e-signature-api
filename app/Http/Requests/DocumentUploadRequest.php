<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DocumentUploadRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to false if authorization logic is needed
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'document' => 'required|file|mimes:pdf|max:10240',
        ];
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
        return [
            'title.required' => 'Title is required',
            'document.required' => 'Document is required',
            'document.mimes' => 'Document must be a PDF file',
            'document.max' => 'Document size must not exceed 10MB',
        ];
    }
}
